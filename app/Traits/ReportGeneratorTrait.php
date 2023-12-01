<?php

namespace App\Traits;

use App\Models\UserFormRequest;

trait ReportGeneratorTrait
{
    /**
     * Cambia las variables que se encuentran en el field body de la tabla formDocs, y las pone por las variables que ingreso el usuario en el formulario
     *
     * @param UserFormRequest $userFormRequest
     * @return string
     */
    public function transcludeReport(UserFormRequest $userFormRequest): string
    {
        $docConfigTemplate = $userFormRequest->doc()->select('body', 'id')->first()->body;
        $customer = $userFormRequest->customer;
        $countryName = $userFormRequest->customer->country ? $userFormRequest->customer->country?->name :  'Ecuatoriana';
        $requestName = $customer->getFullName();

        $dataUserInserted = $userFormRequest->sanitizeValues();

        $docConfigTemplate = $this->transcludeFieldsInserteds($dataUserInserted, $docConfigTemplate);


        // Convierte a mayusculas las letras
        $docConfigTemplate = str_replace('$identification_num', $customer->identification_num, $docConfigTemplate);
        $docConfigTemplate = str_replace('$requestName', strtoupper($requestName), $docConfigTemplate);
        $docConfigTemplate = str_replace('$countryName', strtoupper($countryName), $docConfigTemplate);
        return $docConfigTemplate;
    }


    /**
     * Cambia las variables que se encuentran en el field affidavit de la tabla formDocs, y las pone por las variables que ingreso el usuario en el formulario
     *
     * @param UserFormRequest $userFormRequest
     * @return string
     */
    public function transcludeMinute(UserFormRequest $userFormRequest): string
    {
        $docConfigTemplate = $userFormRequest->doc()->select('affidavit', 'id')->first()->affidavit;
        $customer = $userFormRequest->customer;
        $countryName = $userFormRequest->customer->country ? $userFormRequest->customer->country?->name :  'Ecuatoriana';
        $requestName = $customer->getFullName();

        $dataUserInserted = $userFormRequest->sanitizeValues();


        $docConfigTemplate = $this->transcludeFieldsInserteds($dataUserInserted, $docConfigTemplate);


        // Convierte a mayusculas las letras
        $docConfigTemplate = str_replace('$identification_num', $customer->identification_num, $docConfigTemplate);
        $docConfigTemplate = str_replace('$requestName', strtoupper($requestName), $docConfigTemplate);
        $docConfigTemplate = str_replace('$countryName', strtoupper($countryName), $docConfigTemplate);

        return $docConfigTemplate;
    }


    /**
     * transclude fields inserteds by users
     *
     * @param array $dataUserInserted
     * @param string $docConfigTemplate
     * @return string
     */
    private function transcludeFieldsInserteds(array $dataUserInserted, string &$docConfigTemplate): string
    {

        foreach ($dataUserInserted as $keyUser => $dataUser) {

            // verifica si viene campos relacionados a una fecha
            if (checkValidDate($dataUser)) {
                $dataUser = castDateStringForRequestDocs($dataUser);
            }
            $docConfigTemplate = str_replace('$' . $keyUser,  strtoupper($dataUser), $docConfigTemplate);
        }

        return $docConfigTemplate;
    }
}
