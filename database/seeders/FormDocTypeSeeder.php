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

            ],
            [
                'name' => 'delcaracion_juramentada',

            ],
            [
                'name' => 'copia_certificada',

            ],
            [
                'name' => 'poderes_generales',

            ],

        ];


        foreach ($forms as $form) {
            FormDocType::create($form);
        }
    }
}
