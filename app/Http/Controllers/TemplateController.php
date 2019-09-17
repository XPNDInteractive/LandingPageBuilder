<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Rules\Compressed;
use App\Template;

class TemplateController extends Controller
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
            'title' => 'Templates',
            'create_url' => 'templates/create'
        ]);
    }

    public function create()
    {
        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/templates/create/save',
                'h4'    => 'Create A Template',
                'p' => "Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.",

                'input' => [
                    [
                        'label'=> 'Template name',
                        'type' => 'text',
                        'name' => 'name',
                        'placeholder' => 'your template name'
                    ],
                    [
                        'label'=> 'Upload Template',
                        'type' => 'file',
                        'name' => 'template',
                        'placeholder' => 'Upload your template'
                    ],

                ],
                'submit' => 'Next'
            ]
        ];


        return view('create', [
            'component' => 'data-create',
            'title' => 'Create Template',
            'forms' => $forms
        ]);
    }

    public function save(Request $request){
        //dd($request->all());
        $validatedData = $request->validate([
            'template.*' => ['required', 'mimes:application/x-zip-compressed'],
        ]);

        $request->file('template')->store('templates');
        $request->template->hashName();

        $layout = new Template();
        $layout->name = $request->input('name');
        $layout->save();

        $path = storage_path() . '/app/' . $request->input('name') . '/' . $request->template->hashName();
        $templatesPath = public_path() . '/storage/templates/';

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


        return redirect('/storage/templates/' . $request->input('name'));
    }
}
