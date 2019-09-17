<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Stylesheet;
use App\Script;

class SectionController extends Controller
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
            'title' => 'Sections',
            'create_url' => 'sections/create'
        ]);
    }

    public function editor(Request $request)
    {
        $id = $request->query('section');
        $layout = Section::where('id', $id)->first();

        if(is_null($layout)){
            return abort(404);
        }

        return view('codeeditor');
    }

    public function preview(Request $request)
    {
        $id = $request->query('section');
        $layout = Section::where('id', $id)->first();

        if(is_null($layout)){
            return abort(404);
        }

        return view('codeeditor');
    }

    public function create()
    {

        $forms = [
            'create' => [
                'method' => 'post',
                'action' => '/sections/create/save',
                'h4'    => 'Create A Section',
                'p' => "Your Orginization is used as the alias for applicatons added to your dashboard and so users can easily find and access your Orginization's applications.",

                'input' => [
                    [
                        'label'=> 'Section name',
                        'type' => 'text',
                        'name' => 'name',
                        'placeholder' => 'your section name'
                    ],





                ],
                'submit' => 'Next'
            ]
        ];

        return view('create', [
            'component' => 'data-create',
            'title' => 'Create Section',
            'forms' => $forms
        ]);
    }

    public function save(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $layout = new Section();
        $layout->name = $request->input('name');
        $layout->save();


        return redirect()->route('sections_editor', ['section' => $layout->id]);
    }
}
