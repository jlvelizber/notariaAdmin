<?php

namespace Database\Seeders;

use App\Models\FormDoc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formsDocs = [
            [
                'name' => 'Permiso de Salida - Autorizando Contraparte',
                'code_name' => 'Permiso de Salida - Autorizando Contraparte',
                'field_requests' => json_encode([ 'nombre' => ['required' => true, 'type' => 'text'] ], true),
                'body' => 'Permiso de Salida - Autorizando Cont ${nombre}'
            ],
            [
                'name' => 'Permiso de Salida - Menor viaja solo',
                'code_name' => 'Permiso de Salida - Menor viaja solo',
                'field_requests' => json_encode([ 'nombre' => ['required' => true, 'type' => 'text'] ], true),
                'body' => 'Permiso de Salida - Autorizando Cont ${nombre}'
            ],
            [
                'name' => 'Permiso de Salida - Poder especial',
                'code_name' => 'Permiso de Salida - Poder especial',
                'field_requests' => json_encode([ 'nombre' => ['required' => true, 'type' => 'text'] ], true),
                'body' => 'Permiso de Salida - Autorizando Cont ${nombre}'
            ],
        ];

        foreach ($formsDocs as $formDoc) {

            FormDoc::create($formDoc);
            
        }
    }
}
