<?php

namespace App\Http\Controllers;

use App\Make;
use App\Model;
use Illuminate\Http\Request;
use App\Package;
use App\Rules\Compressed;
use App\Layout;
use App\Year;


class ModelController extends Controller
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
            'title' => 'Models',
            'create_url' => 'models/create',
            'count' => Model::count(),
            'columns' => [
                'Name' => 'name',
                'Make' => 'make_id',
                
                
            ],
            'rows' => Model::orderBy('make_id', 'asc')->paginate(10)
        ]);
    }

    public function create()
    {
        $makes = [];

        foreach(Make::all() as $make){
            $makes[$make->id] = $make->name;
        }

        $years = [];

        foreach(Year::all() as $year){
            $years[$year->id] = $year->year;
        }

        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/models/create/save',
                'h4'    => 'Create a new Model',
                'p' => "The model make and manufacturer must already be created before creating your model.",

                'input' => [
                    [
                        'label'=> 'Make Name',
                        'type' => 'select',
                        'name' => 'make',
                        'options' => $makes
                    ],

                    [
                        'label'=> 'Model Name',
                        'type' => 'text',
                        'name' => 'name',
                        
                    ],

                    [
                        'label'=> 'Model Year',
                        'type' => 'select',
                        'name' => 'year',
                        'options' => $years
                    ],


                ],
                'submit' => 'Next'
            ]
        ];


        return view('create', [
            'component' => 'data-create',
            'title' => 'Create Model',
            'forms' => $forms
        ]);
    }

    public function save(Request $request){
        $validatedData = $request->validate([
            'make' => ['required'],
            'name' => ['required', 'string'],
            'year' => ['required'],
        ]);

        $man = Model::where('name', $request->input('name'))->first();

        if(is_null($man)){
            $man = new Model();
            $man->make_id = $request->input('make');
            $man->name = $request->input('name');
            $man->save();
        }

      
     
        return redirect()->route('models')->with('success', 'successfully created model "'.$man->name.'"');
    }
}
