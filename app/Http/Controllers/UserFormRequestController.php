<?php

namespace App\Http\Controllers;

use App\Events\PermisoSalidaSuccesfull;
use App\Events\UserFormRequestSaved;
use App\Http\Resources\UserFormRequestResource;
use App\Models\FormDoc;
use App\Models\FormDocType;
use App\Models\UserFormRequest;
use App\Models\UserFormStatus;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserFormRequestController extends Controller
{
    /**
     * List kinds of user's requests
     */
    public function listRequestsByFormType(string $docFormRoute)
    {
        $docType = FormDocType::where('route_name', $docFormRoute)->select('id')->first();
        if (!$docType) return abort(404);

        // escoge escoge los ids de la definicion de los documentos
        $docFormsId = $docType->docs()->select('id')->get();


        $queryInIds = [];
        foreach ($docFormsId as $form) {
            $queryInIds[] = $form->id;
        }


        $requests = UserFormRequest::whereIn('form_doc_id', $queryInIds)->with(
            [
                'customer',
                'doc',
                'doc.category',
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
        $userForm =  $userFormRequest->with(['customer', 'doc',  'doc.category', 'status'])->where('id', $userFormRequest->id)->first();
        
        /**
         * sanitiza los valores nulos que de acuerdo a una anomalia va con datos que no son del formulario
         */
        $userForm->form_request_body = $userForm->sanitizeValues();

        // genera values del form
        $userForm->doc->setValuesToRequests($userForm->form_request_body);

        return Inertia::render('Requests/Show', ['request' => $userForm]);
    }


    /**
     * Display the specified resource.
     */
    public function edit(UserFormRequest $userFormRequest)
    {
        $userForm = $userFormRequest->with(['customer', 'doc','doc.category', 'status'])->where('id', $userFormRequest->id)->first();
        // dd($userForm);
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
        /** verifica si va a 0 o cambiar de estado o simplementa a ctualizar campos */
        if ($request->has('status')) {
            $formStatus = UserFormStatus::where('code', $request->get('status'))->first();
            if ($formStatus) {
                $userFormRequest->status_id = $formStatus->id;
            }
        } else {
            /**
             * Va a actualizar los campos del formulario
             */
            $userFormRequest->form_request_body =  json_encode($request->all());
        }


        $userFormRequest->save();


        // Una vez guardado vamos a validar que tipo de formulario es 
        // si es permiso de salida y el estado que va a guardar es 'finalizado' va a enviar notificacion
        
        if ($request->has('status')) {
            $formStatus = UserFormStatus::where('code', $request->get('status'))->first();
            $formTypeName = $userFormRequest->doc->category->name;
            if ($formStatus->code === 'finalizado' && $formTypeName === 'permiso_salida') {
                event(new PermisoSalidaSuccesfull($userFormRequest));
            }
        }

        return redirect()->route('requests.formDocType.index',['formDocType' => $userFormRequest->doc->category->route_name]);
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

            $requestsForm = $request->except('codeForm');

            // Vlidamos
            $rules = $this->generateRulesValidations(json_decode($docForm->field_requests, true));

            $validator = Validator::make($requestsForm, $rules);

            if ($validator->passes()) {
                // validamos si viene algun FILE
                foreach ($requestsForm as $key => $requestForm) {

                    $isAFile = $request->hasFile($key);
                    if ($isAFile) {
                        $urlFile = $this->uploadAttachmentFile($requestForm, $request->get('codeForm'));
                        // actualiza request con la path
                        $requestsForm[$key] = $urlFile;
                    }
                }

                $params = [
                    'form_doc_id' => $docForm->id,
                    'user_id' => $request->user()->id,
                    'form_request_body' => json_encode($requestsForm),
                    'status_id' => UserFormStatus::where('code', 'requerido')->first()->id,

                ];
                $userFormRequest = new  UserFormRequest();
                $userFormRequest->fill($params);
                $userFormRequest->save();

                event(new UserFormRequestSaved($userFormRequest));

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

    /**
     * Upload a file and return their name in storage
     */
    private function uploadAttachmentFile(UploadedFile $requestFile, $path): string
    {
        $fileName = $requestFile->store($path);
        return $fileName;
    }

    /**
     * Download a file and return its name in storage
     */
    public function downloadFile(string $path, string $url) 
    {
        $fullUrl = storage_path('app/' . $path.'/'.$url);
        return response()->download($fullUrl, $url);
    }
}
