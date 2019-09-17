<?php

namespace App\Http\Controllers;

use App\Make;
use Illuminate\Http\Request;
use App\Package;
use App\Rules\Compressed;
use App\Layout;
use App\Year;
use App\MakeYear;
use App\Model;
use App\BodyType;
use App\Asset;
use App\AssetAspect;
use App\AssetType;


class LookupController extends Controller
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
    public function listYears()
    {
        return view('list', [
            'component' => 'data-list',
            'title' => 'Lookup',
            'create_url' => 'lookup/create/year',
            'item_url' => 'lookup/',
            'count'   => Year::count(),
            'columns' => [
                'Year' => 'year',
                
            ],
            'rows' => Year::orderBy('year', 'desc')->paginate(25)
        ]);
    }

    public function listMakesByYear(Request $request, $year)
    {
       
        return view('list', [
            'component' => 'data-list',
            'title' => $year . ' Makes',
            'create_url' => '/lookup/create/make?year='.$year,
            'item_url' => '/lookup/'.$year.'/',
            'count'   => Year::where('year', $year)->first()->makes()->count(),
            'columns' => [
                'Make' => 'name',
                
            ],
            'rows' => Year::where('year', $year)->first()->makes()->get()
        ]);
    }

    public function listModelsByMakeYear(Request $request, $year, $make)
    {
        $myid = MakeYear::where('year_id', Year::where('year', $year)->first()->id)
            ->where('make_id', Make::where('name', $make)->first()->id)->first();
       
        return view('list', [
            'component' => 'data-list',
            'title' => $year . ' ' . $make . ' Models',
            'create_url' => '/lookup/create/model?year='.$year.'&make='.$make,
            'item_url' => "/lookup/$year/$make/",
            'count'   => Model::where('make_years_id', $myid->id)->count(),
            'columns' => [
                'Make' => 'name',
            ],
            'rows' => Model::where('make_years_id', $myid->id)->get()
        ]);
    }

    public function listBodyTypesByMakeModelYear(Request $request, $year, $make, $model)
    {
        $myid = MakeYear::where('year_id', Year::where('year', $year)->first()->id)
            ->where('make_id', Make::where('name', $make)->first()->id)->first();

        $model_id = Model::where('make_years_id', $myid->id)->where('name', $model)->first()->id;

        return view('list', [
            'component' => 'data-list',
            'title' => $year . ' ' . $make . ' ' . $model . ' Trims',
            'create_url' => "/lookup/create/trim?year=$year&make=$make&model=$model",
            'item_url' => "/lookup/$year/$make/$model/",
            'count'   => Model::where('make_years_id', $myid->id)->count(),
            'columns' => [
                'Make' => 'name',
            ],
            'rows' => BodyType::where('model_id', $model_id)->get()
        ]);
    }

    public function listModelTrimDetail(Request $request, $year, $make, $model, $trim)
    {
        $myid     = MakeYear::where('year_id', Year::where('year', $year)->first()->id)->where('make_id', Make::where('name', $make)->first()->id)->first();
        $model_id = Model::where('make_years_id', $myid->id)->where('name', $model)->first()->id;
        $trim     = BodyType::where('name', $trim)->where('model_id', $model_id)->first();
        $assets   = Asset::where('body_type_id', $trim->id)->get();

        $rows = [];

        foreach($assets as $asset){
           
            if(!isset($rows[$asset->asset_type_id->name])){
                $rows[$asset->asset_type_id->name] = [];
            }

           
            if(isset( $rows[$asset->asset_type_id->name]) && !isset($rows[$asset->asset_type_id->name][$asset->asset_aspect_id->name])){
                $rows[$asset->asset_type_id->name][$asset->asset_aspect_id->name] = array();
            }
            
            $rows[$asset->asset_type_id->name][$asset->asset_aspect_id->name][] = $asset->path;
        }
       

        

        return view('list', [
            'component' => 'trim-details',
            'title' => $year . ' ' . $make . ' ' . $model . ' ' . $trim->name,
            'create_url' => "/lookup/create/asset?year=$year&make=$make&model=$model&trim=$trim->name",
            'item_url' => "",
            'count'   => null,
            'columns' => [],
            'rows' => $rows
        ]);
    }



    public function createYear()
    {
        

        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/lookup/create/year/save',
                'h4'    => 'Create a new year',
                'p' => "Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.",

                'input' => [

                   
                    [
                        'label'=> 'Year',
                        'type' => 'text',
                        'name' => 'year',
                        'placeholder' => ''
                    ],


                ],
                'submit' => 'Next'
            ]
        ];


        return view('create', [
            'component' => 'data-create',
            'title' => 'Create Year',
            'forms' => $forms
        ]);
    }

    public function createMake(Request $request)
    {
        

        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/lookup/create/make/save',
                'h4'    => 'Create a new make for the year ' . $request->query('year'),
                'p' => "Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.",

                'input' => [

                   
                    [
                        'label'=> 'Make Name',
                        'type' => 'text',
                        'name' => 'make',
                        'placeholder' => ''
                    ],

                    [
                        
                        'type' => 'hidden',
                        'name' => 'year',
                        'value' => $request->query('year')
                    ],


                ],
                'submit' => 'Next'
            ]
        ];


        return view('create', [
            'component' => 'data-create',
            'title' => 'Create Year',
            'forms' => $forms
        ]);
    }

    public function createModel(Request $request)
    {
        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/lookup/create/model/save',
                'h4'    => 'Create a new model for the year ' . $request->query('year') . ' and make ' . $request->query('make'),
                'p' => "Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.",

                'input' => [

                   
                    [
                        'label'=> 'Model Name',
                        'type' => 'text',
                        'name' => 'model',
                        'placeholder' => ''
                    ],
                    [
                        
                        'type' => 'hidden',
                        'name' => 'make',
                        'value' => $request->query('make')
                    ],
                    [
                        
                        'type' => 'hidden',
                        'name' => 'year',
                        'value' => $request->query('year')
                    ],


                ],
                'submit' => 'Next'
            ]
        ];


        return view('create', [
            'component' => 'data-create',
            'title' => 'Create Year',
            'forms' => $forms
        ]);
    }

    public function createTrim(Request $request)
    {
        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/lookup/create/trim/save',
                'h4'    => 'Create a new Trim for the year ' . $request->query('year') . ' and make ' . $request->query('make'). ' and model ' . $request->query('model'),
                'p' => "Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.",

                'input' => [

                   
                    [
                        'label'=> 'Trim Name',
                        'type' => 'text',
                        'name' => 'trim',
                        'placeholder' => ''
                    ],
                    [
                        
                        'type' => 'hidden',
                        'name' => 'make',
                        'value' => $request->query('make')
                    ],
                    [
                        
                        'type' => 'hidden',
                        'name' => 'model',
                        'value' => $request->query('model')
                    ],
                    [
                        
                        'type' => 'hidden',
                        'name' => 'year',
                        'value' => $request->query('year')
                    ],


                ],
                'submit' => 'Next'
            ]
        ];


        return view('create', [
            'component' => 'data-create',
            'title' => 'Create Year',
            'forms' => $forms
        ]);
    }

    public function createAsset(Request $request)
    {   
        $assetTypes  =[];
        foreach(AssetType::all() as $type){
            $assetTypes[$type->id] = $type->name;
        }

        $assetAspect  =[];
        foreach(AssetAspect::all() as $aspects){
            $assetAspect[$aspects->id] = $aspects->name;
        }

        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/lookup/create/asset/save',
                'h4'    => 'Add a new Asset for a ' . $request->query('year') . ' ' . $request->query('make'). ' ' . $request->query('model'). ' ' .$request->query('trim'),
                'p' => "Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.",

                'input' => [

                    [
                        'label'=> 'Asset Type',
                        'type' => 'select',
                        'name' => 'type',
                        'options' => $assetTypes ,
                        'class' => ''
                    ],

                    [
                        'label'=> 'Asset Aspect',
                        'type' => 'select',
                        'name' => 'aspect',
                        'options' => $assetAspect ,
                        'class' => ''
                    ],

                    [
                        'label'=> 'Upload Asset',
                        'type' => 'file',
                        'name' => 'asset',
                       
                    ],

                    [
                        
                        'type' => 'hidden',
                        'name' => 'year',
                        'value' => $request->query('year')
                       
                    ],

                    [
                        
                        'type' => 'hidden',
                        'name' => 'make',
                        'value' => $request->query('make')
                       
                    ],

                    [
                        
                        'type' => 'hidden',
                        'name' => 'model',
                        'value' => $request->query('model')
                       
                    ],

                    [
                        
                        'type' => 'hidden',
                        'name' => 'trim',
                        'value' => $request->query('trim')
                       
                    ],
                ],
                'submit' => 'Next'
            ]
        ];


        return view('create', [
            'component' => 'data-create',
            'title' => 'Create Year',
            'forms' => $forms
        ]);
    }

    public function saveYear(Request $request){

        
        $validatedData = $request->validate([
            'year' => ['required', 'numeric' , 'min:4'],
        ]);

        $man = new Year();
        $man->year = $request->input('year');
        $man->save();
     

        return redirect()->route('lookup')->with('success', 'successfully created year "'.$man->year.'"');
    }

    public function saveModel(Request $request){

        
        $validatedData = $request->validate([
            'model' => ['required', 'string'],
            'make' => ['required', 'string'],
            'year' => ['required', 'numeric' , 'min:4'],
        ]);

        $make = Make::where('name', $request->input('make'))->first();
        $year = Year::where('year', $request->input('year'))->first();
        $makeYear = MakeYear::where('make_id', $make->id)->where('year_id', $year->id)->first();
        
        $model = Model::where('name', $request->input('model'))->where('make_years_id', $makeYear->id)->first();

        if(is_null($model)){
            $model = new Model();
            $model->make_years_id = $makeYear->id;
            $model->name = $request->input('model');
            $model->save();
        }

        return redirect('lookup/' . $request->input('year').'/'.$make->name)->with('success', 'successfully created model "'.$model->name.'"');
    }

    public function saveTrim(Request $request){

        
        $validatedData = $request->validate([
            'trim' => ['required', 'string'],
            'model' => ['required', 'string'],
            'make' => ['required', 'string'],
            'year' => ['required', 'numeric' , 'min:4'],
        ]);

        $make = Make::where('name', $request->input('make'))->first();
        $year = Year::where('year', $request->input('year'))->first();
        
        $makeYear = MakeYear::where('make_id', $make->id)->where('year_id', $year->id)->first();
        
        $model = Model::where('name', $request->input('model'))->where('make_years_id', $makeYear->id)->first();
       
        $trim = BodyType::where('name', $request->input('trim'))->where('model_id', $model->id)->first();
            
        if(is_null($trim)){
            
            $bt = new BodyType();
            $bt->model_id = $model->id;
            $bt->name = $request->input('trim');
            $bt->save();
        }

        return redirect('lookup/' . $year->year.'/'.$make->name.'/'.$model->name)->with('success', 'successfully created trim "'.$bt->name.'"');
    }

    public function saveAsset(Request $request){

        
        $validatedData = $request->validate([
            'type' => ['required', 'numeric'],
            'aspect' => ['required', 'numeric'],
            'trim' => ['required', 'string'],
            'model' => ['required', 'string'],
            'make' => ['required', 'string'],
            'year' => ['required', 'numeric' , 'min:4'],
            'asset' => ['required'],
        ]);
        
        $make = Make::where('name', $request->input('make'))->first();
        $year = Year::where('year', $request->input('year'))->first();
        $makeYear = MakeYear::where('make_id', $make->id)->where('year_id', $year->id)->first();
        $model = Model::where('name', $request->input('model'))->where('make_years_id', $makeYear->id)->first();
        $trim = BodyType::where('name', $request->input('trim'))->where('model_id', $model->id)->first();
            
        $request->file('asset')->store('assets', ['disk' => 'asset']);

        $asset = new Asset();
        $asset->asset_type_id = $request->input('type');
        $asset->asset_aspect_id = $request->input('aspect');
        $asset->body_type_id = $trim->id;
        $asset->path = url('/'). '/storage/assets/' . $request->asset->hashName();
        $asset->save();

        return redirect('lookup/' . $year->year.'/'.$make->name.'/'.$model->name.'/'.$trim->name)->with('success', 'successfully created asset "'.$trim->name.'"');
    }
}
