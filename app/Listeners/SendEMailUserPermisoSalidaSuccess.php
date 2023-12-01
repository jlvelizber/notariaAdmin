<?php

namespace App\Listeners;

use App\Events\PermisoSalidaSuccesfull;
use App\Traits\ReportGeneratorTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEMailUserPermisoSalidaSuccess
{


    use ReportGeneratorTrait;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PermisoSalidaSuccesfull $event): void
    {
        /**
         * Se encarga de gengerar el PDF de carga para enviarselo al usuario en sesion;
         */

        $text =  $this->transcludeMinute($event->userFormRequest);

        $view = view()->make('certificados.print', compact('text'))->render();
        $pdf  = app()->make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pathFile = storage_path('app/permisos-salida-exitosos/permiso_salida_carta_' . time() . '.pdf');
        $pdf->save($pathFile);
        auth()->user()->sendEmailMinute($pathFile);
    }
}
