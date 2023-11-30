<?php

namespace App\Http\Controllers;

use App\Models\UserFormRequest;
use App\Traits\ReportGeneratorTrait;

class ReportController extends Controller
{
    use ReportGeneratorTrait;


    public function generateRequestDoc(UserFormRequest $userFormRequest)
    {
        $text = $this->transcludeReport($userFormRequest);

        $view = view()->make('certificados.print', compact('text'))->render();
        $pdf  = app()->make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return  $pdf->stream('Certificado.pdf');
    }
}
