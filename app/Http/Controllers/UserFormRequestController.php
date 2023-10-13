<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserFormRequestResource;
use App\Models\FormDoc;
use App\Models\UserFormRequest;
use App\Models\UserFormStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserFormRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = UserFormRequest::with(
            [
                'customer',
                'doc',
                'status'
            ]
        )->orderby('created_at', 'desc')->get();

        return Inertia::render('Requests/index', ['requests' => $requests]);
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
    public function show(UserFormRequest $userFormRequest)
    {
        $userForm = $userFormRequest->load(['customer', 'doc', 'status']);

       
        return Inertia::render('Requests/edit', ['request' => $userForm]);
    }
    
    
    /**
     * Display the specified resource.
     */
    public function edit(UserFormRequest $userFormRequest)
    {
        $userForm = $userFormRequest->with(['customer', 'doc', 'status'])->where('id', $userFormRequest->id)->first();

        /**
         * sanitiza los valores nulos que de acuerdo a una anomalia va con datos que no son del formulario
         */
        $userForm->form_request_body = $userForm->sanitizeValues();

        // genera values del form
        $userForm->doc->setValuesToRequests($userForm->form_request_body);

      

        return Inertia::render('Requests/Edit', ['request' => $userForm]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserFormRequest $userFormRequest)
    {
        $userFormRequest->form_request_body =  json_encode( $request->all());
        $userFormRequest->save();
        return redirect()->route('requests.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserFormRequest $userFormRequest)
    {
        //
    }

    /**
     * API
     */

    public function getMyRequests(Request $request)
    {
        $userId = $request->user()->id;

        $userRequests = UserFormRequest::where('user_id', $userId)->orderBy('id', 'desc')->get();

        return UserFormRequestResource::collection($userRequests);
    }



    
    /**
     * 
     */
    public function postSaveRequestClient(Request $request)
    {
        $docForm = FormDoc::where('code_name', $request->get('codeForm'))->select('id', 'field_requests')->first();
        if ($docForm) {

            $rules = $this->generateRulesValidations($docForm->field_requests);

            // dd($request->get('dataForm'));

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
    private function generateRulesValidations(array $fieldsarray)
    {
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
