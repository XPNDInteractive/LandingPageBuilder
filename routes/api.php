<?php

use Illuminate\Http\Request;
use App\Make;
use App\Model;
use App\Year;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/make/{makeId}/models', function(Request $request, $makeId){
    return response()->json(Model::where('make_id', $makeId)->get());
});

Route::middleware('auth:api')->get('/model/{modelId}/years', function(Request $request, $modelId){
    return response()->json(Model::where('id', $modelId)->first()->years()->get());
});