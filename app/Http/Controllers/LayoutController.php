<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Rules\Compressed;
use App\Layout;

class LayoutController extends Controller
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
            'component' => 'layout-list',
            'title' => 'Layouts',
            'create_url' => 'layouts/create',
            'layouts' => Layout::all()
        ]);
    }

    public function preview(Request $request)
    {
        $layout  = Layout::where('id', $request->query('layout'))->first();

        if(is_null($layout)){
            abort(500);
        }

        $path = public_path() . '/storage/layouts/' . $layout->name . '/index.html';
        $layoutContent = file_get_contents($path);

        return view('preview', [
            'component' => 'layout-list',
            'title' => 'Layouts',
            'create_url' => 'layouts/create',
            'layout' => $layout,
            'preview' => $layoutContent
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

    public function save(Request $request){
      
        $validatedData = $request->validate([
            'layout.*' => ['required', 'mimes:application/x-zip-compressed'],
        ]);

        

        $request->file('layout')->store('layouts');



        $layout = new Layout();
        $layout->name = basename($request->layout->getClientOriginalName(), '.zip');
        $layout->save();

        $path = storage_path() . '/app/public/layouts/' . $request->layout->hashName();
        $templatesPath = public_path() . '/storage/layouts/';

        if(!file_exists($templatesPath)){
            mkdir($templatesPath);
        }

        $zip = new \ZipArchive;
        if ($zip->open($path) === TRUE) {
            $zip->extractTo($templatesPath);
            $zip->close();

        } else {
           throw new Exception("Unable to extract contents to template directory");
        }


        return redirect('/storage/layouts/' . $layout->name);
    }
}
