<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FormBuilder\FormBuilderDetialResource;
use App\Http\Resources\FormBuilder\FormBuilderResource;
use App\Models\FormTemplate;


class FormBuilderController extends Controller
{
    public function index()
    {
        return FormBuilderResource::collection(FormTemplate::all());
    }

    public function show(FormTemplate $formtemplate)
    {
        return new FormBuilderDetialResource($formtemplate);
    }

    public function store(Request $request)
    {

        // return $request->json()->all();
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
        ]);

        $formtemplate = FormTemplate::create($request->all());

        return new FormBuilderDetialResource($formtemplate);
    }

    public function update(Request $request, FormTemplate $formtemplate)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
        ]);

        $formtemplate->update($request->all());

        return new FormBuilderDetialResource($formtemplate);
    }
    public function destroy(FormTemplate $formtemplate)
    {
        $formtemplate->delete();
        return response()->json(null, 204);
    }
}
