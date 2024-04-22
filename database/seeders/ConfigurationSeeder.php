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

        $generalConfig = [
            'key' => ConfigTypeEnum::CONFIGURACION_GENERAL_KEY->value,
            'label' => 'General',
        ];

        Configuration::create($generalConfig);

        $conf = Configuration::where('key', '=', ConfigTypeEnum::CONFIGURACION_GENERAL_KEY->value)->first();


        $children = [
            new Configuration([
                'key' => 'title_notary',
                'label' => 'Nombre de la notaría',
                'value' => config('app.name')
            ]),
            new Configuration([
                'key' => 'notary_name',
                'label' => 'Nombre del notario',
                'value' => 'Sr(a) Notario(a)'
            ]),
            new Configuration([
                'key' => 'address_notary',
                'label' => 'Dirección de la notaría',
                'value' => 'En algun lugar'
            ])

        ];

        $conf->children()->saveMany($children);

        /**
         * get Configuration
         */
    }
}
