<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $company = $request->user()->companies()->first();

        if(!is_null($company)){
            $package = $company->package()->first();

            if(!is_null($package) && $package->name !== "Free Trail"){

                return view('home', [
                    'company' => $company
                ]);
            }

            elseif(!is_null($package) && $package->name == "Free Trail"){
                $expires = date('Y-m-d', strtotime($company->created_at . ' + 14 days'));
                $today   = date('Y-m-d', time());
                $diffSec = (strtotime($expires) - strtotime($today)) / 86400;
                if($diffSec > 0){
                    return view('home', [
                        'company' => $company
                    ]);
                }

                else{
                    return redirect('package/select');
                }

            }

            else{

            }

        }

        else{
            return redirect('/user/company');
        }

    }
}
