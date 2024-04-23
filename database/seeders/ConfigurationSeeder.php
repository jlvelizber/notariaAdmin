<?php

namespace Database\Seeders;

use App\Enums\ConfigTypeEnum;
use App\Models\Configuration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Configuration::truncate();

        $generalConfig = [
            'key' => ConfigTypeEnum::CONFIGURACION_GENERAL_KEY->value,
            'label' => 'General',
        ];

        Configuration::create($generalConfig);

        $conf = Configuration::getGeneralConfig()->first();


        $children = [
            new Configuration([
                'key' => 'title_notary',
                'label' => 'Nombre de la notaría',
                'value' => config('app.name'),
                'instuctions' => 'Nombre oficial de la notaría. Ejemplo: NOTARIA V DEL CANTÓN GUAYAQUIL'
            ]),
            new Configuration([
                'key' => 'notary_name',
                'label' => 'Nombre del notario',
                'value' => 'Sr(a) Notario(a)',
                'instuctions' => 'Nombre completo del notario firmante. Ejemplo: AB. MARIA DEL CARMEN CARVAJAL AYALA'
            ]),
            new Configuration([
                'key' => 'designation_notary_name',
                'label' => 'Designación del notario',
                'value' => 'NOTARIA TITULAR CUARTA DEL CANTÓN DAULE',
                'instuctions' => 'Cargo que ejerce en la notaría. Ejemplo: NOTARIA TITULAR, NOTARIA SUPLENTE QUINTA DEL CANTÓN GUAYAQUIL'
            ]),
            new Configuration([
                'key' => 'address_notary',
                'label' => 'Dirección de la notaría',
                'value' => 'En algun lugar',
                'instuctions' => 'lugar donde se encuentra la notaría. Ejemplo: Circunvalación Sur - GUAYAQUIL'
            ])

        ];

        $conf->children()->saveMany($children);

        /**
         * get Configuration
         */
    }
}
