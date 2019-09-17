<?php

namespace App\Http\Controllers;

use App\Make;
use Illuminate\Http\Request;
use App\Package;
use App\Rules\Compressed;
use App\Layout;
use App\Manufacturer;
use App\Asset;
use App\AssetType;
use App\Model;
use App\Year;


class AssetController extends Controller
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
            'title' => 'Assets',
            'create_url' => 'assets/create',
            'count'   => Asset::count(),
            'columns' => [
                'Path' => 'path',
            ],
            'rows' => Asset::paginate(10)
        ]);
    }

    public function create()
    {
        return view('create', [
            'component' => 'asset-upload',
            'title' => 'Assets',
            'create_url' => 'assets/create',
            'count'   => Asset::count(),
            'columns' => [
                'Path' => 'path',
            ],
            'rows' => Asset::paginate(10)
        ]);
    }

    public function createModel()
    {
        $makes = [
            '' => 'Select the make'
        ];

        foreach(Make::all() as $make){
            $makes[$make->id] = $make->name;
        }

        $models = [];

        foreach(Model::all() as $m){
            $models[$m->id] = $m->name;
        }

        $years = [];

        foreach(Year::all() as $m){
            $years[$m->id] = $m->year;
        }

        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/assets/create/save',
                'h4'    => 'Create a Asset',
                'p' => "Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.",

                'input' => [

                    [
                        'type' => 'hideen',
                        'name' => 'type',
                        'value' => AssetType::where('name', 'model')->first()->id
                    ],

                    [
                        'label'=> 'Make',
                        'type' => 'select',
                        'name' => 'make',
                        'options' => $makes,
                        'class' => 'mmy-make-selector'
                    ],

                    [
                        'label'=> 'Model',
                        'type' => 'select',
                        'name' => 'model',
                        'options' => [],
                        'class' => 'mmy-model-selector'
                    ],

                    [
                        'label'=> 'Year',
                        'type' => 'select',
                        'name' => 'model',
                        'options' => [],
                        'class' => 'mmy-year-selector'
                    ],

                    [
                        'label'=> 'Upload',
                        'type' => 'file',
                        'name' => 'asset',
                       
                    ],


                ],
                'submit' => 'Next'
            ]
        ];


        return view('create', [
            'component' => 'data-create',
            'title' => 'Add Model Assets',
            'forms' => $forms
        ]);
    }

    public function save(Request $request){
        $validatedData = $request->validate([
            'manufacture' => ['required'],
            'name' => ['required', 'string'],
        ]);

        $man = new Make();
        $man->name = $request->input('name');
        $man->save();
        $man->Manufactures()->attach(
            $request->input('manufacture')
        );

        return redirect()->route('makes')->with('success', 'successfully created Make "'.$man->name.'"');
    }
}
