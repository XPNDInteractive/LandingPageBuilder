<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index')->name('front');

Route::get('/user/company', 'UserController@company')->name('user_company');
Route::get('/package/select', 'PackageController@select')->name('select_package');

Route::post('/company/save', 'CompanyController@save')->name('company_save');

Route::get('/templates', 'TemplateController@list')->name('templates');
Route::get('/templates/create', 'TemplateController@create')->name('templates_create');
Route::post('/templates/create/save', 'TemplateController@save')->name('templates_save');

Route::get('/layouts', 'LayoutController@list')->name('layouts');
Route::get('/layouts/preview', 'LayoutController@preview')->name('layouts_preview');
Route::get('/layouts/create', 'LayoutController@create')->name('layouts_create');
Route::post('/layouts/create/save', 'LayoutController@save')->name('layouts_save');



Route::get('/manufactures', 'ManufacturerController@list')->name('manufactures');
Route::get('/manufactures/create', 'ManufacturerController@create')->name('manufactures_create');
Route::post('/manufactures/create/save', 'ManufacturerController@save')->name('manufactures_save');

Route::get('/lookup', 'LookupController@listYears')->name('lookup');
Route::get('/lookup/create/year', 'LookupController@createYear')->name('lookup_create_year');
Route::get('/lookup/create/make', 'LookupController@createMake')->name('lookup_create_make');
Route::get('/lookup/create/model', 'LookupController@createModel')->name('lookup_create_model');
Route::get('/lookup/create/trim', 'LookupController@createTrim')->name('lookup_create_trim');
Route::get('/lookup/create/asset', 'LookupController@createAsset')->name('lookup_create_asset');
Route::post('/lookup/create/year/save', 'LookupController@saveYear')->name('lookup_save_year');
Route::post('/lookup/create/make/save', 'LookupController@saveMake')->name('lookup_save_make');
Route::post('/lookup/create/model/save', 'LookupController@saveModel')->name('lookup_save_model');
Route::post('/lookup/create/trim/save', 'LookupController@saveTrim')->name('lookup_save_trim');
Route::post('/lookup/create/asset/save', 'LookupController@saveAsset')->name('lookup_save_asset');
Route::get('/lookup/{year}', 'LookupController@listMakesByYear')->name('lookup_by_year');
Route::get('/lookup/{year}/{make}', 'LookupController@listModelsByMakeYear')->name('lookup_by_make_year');
Route::get('/lookup/{year}/{make}/{model}', 'LookupController@listBodyTypesByMakeModelYear')->name('lookup_by_make_model_year');
Route::get('/lookup/{year}/{make}/{model}/{trim}', 'LookupController@listModelTrimDetail')->name('lookup_by_make_model_year_trim');

Route::get('/models', 'ModelController@list')->name('models');
Route::get('/models/create', 'ModelController@create')->name('models_create');
Route::post('/models/create/save', 'ModelController@save')->name('models_save');


Route::get('/assets', 'AssetController@list')->name('assets');
Route::get('/assets/create', 'AssetController@create')->name('assets_create');
Route::get('/assets/create/model', 'AssetController@createModel')->name('assets_create_model');
Route::get('/assets/create/layout', 'AssetController@createLayout')->name('assets_create_layout');
Route::get('/assets/create/system', 'AssetController@createGlobal')->name('assets_create_system');
Route::post('/assets/create/save', 'AssetController@save')->name('assets_save');