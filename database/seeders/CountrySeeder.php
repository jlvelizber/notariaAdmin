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
            "Chilena",
            "Colombiana",
            "Costarricense",
            "Cubana",
            "Dominicana",
            "Ecuatoriana",
            "Española",
            "Estadounidense",
            "Filipina",
            "Guatemalteca",
            "Guineana",
            "Hondureña",
            "Israelí",
            "Italiana",
            "Japonés",
            "Mexicana",
            "Nicaragüense",
            "Panameña",
            "Paraguaya",
            "Peruana",
            "Portugués",
            "Puertorriqueña",
            "Saharahui",
            "Salvadoreña",
            "Sudafricana",
            "Turca",
            "Uruguaya",
            "Venezolana"
        );

        foreach ($nacionalidades as $nacionalidad) {
            Country::create(['name' => $nacionalidad, 'active' => true]);
        }
    }
}
