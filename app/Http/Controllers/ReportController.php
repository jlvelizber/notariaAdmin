<?php

namespace App\Http\Controllers;

use App\Models\UserFormRequest;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function generateRequestDoc(UserFormRequest $userFormRequest)
    {
        $docConfigTemplate = $userFormRequest->doc()->select('body', 'id')->first()->body;
        $customer = $userFormRequest->customer;
        $countryName = $userFormRequest->customer->country->name;
        $requestName = $customer->getFullName();

        $dataUserInserted = $userFormRequest->sanitizeValues();


        foreach ($dataUserInserted as $keyUser => $dataUser) {

            // verifica si viene campos relacionados a una fecha
            if(checkValidDate($dataUser)) {
                $dataUser = castDateStringForRequestDocs($dataUser);
            }
            $docConfigTemplate = str_replace('$' . $keyUser,  strtoupper($dataUser), $docConfigTemplate);
        }


        // Convierte a mayusculas las letras
        $docConfigTemplate = str_replace('$identification_num', $customer->identification_num, $docConfigTemplate);
        $docConfigTemplate = str_replace('$requestName', strtoupper($requestName), $docConfigTemplate);
        $docConfigTemplate = str_replace('$countryName', strtoupper($countryName), $docConfigTemplate);



        $text = $docConfigTemplate;

        $view = view()->make('certificados.print', compact('text'))->render();
        $pdf  = app()->make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return  $pdf->stream('Certificado.pdf');
    }
}
