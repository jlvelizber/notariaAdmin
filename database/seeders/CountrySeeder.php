<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nacionalidades = array(
            "Andorrano",
            "Argentina",
            "Beliceño",
            "Boliviano",
            "Brasileño",
            "Canadiense",
            "Chileno",
            "Colombiano",
            "Costarricense",
            "Cubano",
            "Dominicano",
            "Ecuatoriano",
            "Español",
            "Estadounidense",
            "Filipino",
            "Guatemalteco",
            "Guineano",
            "Hondureño",
            "Israelí",
            "Italiano",
            "Japonés",
            "Mexicano",
            "Nicaragüense",
            "Panameño",
            "Paraguayo",
            "Peruano",
            "Portugués",
            "Puertorriqueño",
            "Saharahui",
            "Salvadoreño",
            "Sudafricano",
            "Turco",
            "Uruguayo",
            "Venezolano"
        );

        foreach ($nacionalidades as $nacionalidad) {
            Country::create(['name' => $nacionalidad, 'active' => true]);
        }
    }
}
