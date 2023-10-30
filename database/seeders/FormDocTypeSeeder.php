<?php

namespace Database\Seeders;

use App\Models\FormDocType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormDocTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = [
            [
                'name' => 'permiso_salida',
                'display_name' => 'Permiso de Salida',
                'route_name' => 'permiso-salida',

            ],
            [
                'name' => 'delcaracion_juramentada',
                'display_name' => 'Declaración Juramentada',
                'route_name' => 'declaracion-juramentada'

            ],
            [
                'name' => 'copia_certificada',
                'display_name' => 'Copia Certificada',
                'route_name' => 'copia-certificada'

            ],
            [
                'name' => 'poderes_generales',
                'display_name' => 'Poderes generales',
                'route_name' => 'poderes-generales'

            ],

        ];


        foreach ($forms as $form) {
            FormDocType::create($form);
        }
    }
}
