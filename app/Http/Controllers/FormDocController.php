<?php

namespace App\Http\Controllers;

use App\Http\Resources\FormDocResource;
use App\Models\FormDoc;
use Illuminate\Http\Request;

class FormDocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FormDoc $formDoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormDoc $formDoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormDoc $formDoc)
    {
        //
    }


    /***
     * Get categories or types of forms document
     */

    public function getFormsByCategory($formType)
    {
        $docs = (new FormDoc())->getByCategory($formType);
        return FormDocResource::collection($docs);
    }

    /**
     * get FOrmDoc by Code
     */
    public function getFormByCode($codeForm)
    {
        $formDoc = FormDoc::where('code_name', $codeForm)->first();

        if(!$formDoc) return response()->json(['message'=> 'Document not found'], 404);

        return new FormDocResource($formDoc);
    }
}
