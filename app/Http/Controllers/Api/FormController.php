<?php

namespace App\Http\Controllers\Api;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Form\FormResource;
use App\Http\Resources\Form\FormDetialResource;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FormResource::collection(Form::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'form_template_id' => 'required',
            'form' => 'required',
        ]);

        $formtemplate = Form::create($request->all());

        return new FormDetialResource($formtemplate);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new FormDetialResource(Form::find($id));
    }
}
