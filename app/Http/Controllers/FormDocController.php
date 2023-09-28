<?php

namespace App\Http\Controllers;

use App\Http\Resources\FormDocResource;
use App\Models\FormDoc;
use App\Models\UserFormRequest;
use App\Models\UserFormStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        if (!$formDoc) return response()->json(['message' => 'Document not found'], 404);

        return new FormDocResource($formDoc);
    }


    /**
     * 
     */
    public function postSaveRequestClient(Request $request)
    {
        $docForm = FormDoc::where('code_name', $request->get('codeForm'))->select('id', 'field_requests')->first();
        if ($docForm) {

            $rules = $this->generateRulesValidations($docForm->field_requests);


            $dataFormArray = json_decode($request->get('dataForm'), true);

            $validator = Validator::make($dataFormArray, $rules);


            if ($validator->passes()) {
                $params = [
                    'form_doc_id' => $docForm->id,
                    'user_id' => $request->user()->id,
                    'form_request_body' => $request->get('dataForm'),
                    'status_id' => UserFormStatus::where('code', 'requerido')->first()->id,

                ];
                $userFormRequest = new  UserFormRequest();
                $userFormRequest->fill($params);
                $userFormRequest->save();

                return response()->json(['message' => 'Solicitud ingresada correctamente']);
            }

            return response()->json([
                'message' => $validator->errors()->first(), 
                'errors' => $validator->errors()
            ], 422);
        }
    }


    /**
     * Genera las reglas del requerimiento que necesita
     */
    private function generateRulesValidations(string $fields)
    {
        $fieldsarray = json_decode($fields, true);

        if (is_array($fieldsarray)) {

            $fieldRules = [];

            for ($i = 0; $i < count($fieldsarray); $i++) {
                $fields = $fieldsarray[$i]['fields'];
                for ($j = 0; $j < count($fields); $j++) {
                    $fieldRules[$fields[$j]['name']] = $fields[$j]['rules'];
                }
            }

            return $fieldRules;
        }

        return [];
    }
}
