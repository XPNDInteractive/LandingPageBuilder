<?php

namespace App\Http\Controllers;

use App\Industry;
use Illuminate\Http\Request;
use App\Package;
use App\Rules\Compressed;
use App\Layout;


class IndustryController extends Controller
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
    public function list()
    {
        return view('list', [
            'component' => 'data-list',
            'title' => 'Industries',
            'create_url' => 'industries/create',
            'columns' => [
                'Name' => 'name',
            ],
            'rows' => Industry::all()
        ]);
    }

    public function create()
    {
        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/layouts/create/save',
                'h4'    => 'Upload your layout',
                'p' => "Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.",

                'input' => [

                    [
                        'label'=> 'Upload Layout',
                        'type' => 'file',
                        'name' => 'layout',
                        'placeholder' => 'Upload your layout'
                    ],

                ],
                'submit' => 'Next'
            ]
        ];


        return view('create', [
            'component' => 'data-create',
            'title' => 'Create Layout',
            'forms' => $forms
        ]);
    }
}
