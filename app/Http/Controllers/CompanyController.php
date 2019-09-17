<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Package;


class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('');
    }

    public function save(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:companies|max:255',
            'user' => 'required|integer',
        ]);

        $company = new Company();
        $company->name = $request->input('name');
        $company->package_id  = Package::where('name', 'free trail')->first()->id;
        $company->user_id = $request->input('user');
        $company->save();
        $company->users()->attach($request->input('user'));




        return redirect('package/select');
    }
}
