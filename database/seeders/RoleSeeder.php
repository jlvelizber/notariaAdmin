<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'administrator',
                'display_name' => 'Administrador',
                'description' => 'Administracion',
            ],
            [
                'name' => 'secreatary',
                'display_name' => 'Secretari@',
                'description' => 'Ayudante de la nataria',
            ],
            [
                'name' => 'notary',
                'display_name' => 'Notari@',
                'description' => 'Jefe de negocio',
            ],
        ];

        
        foreach ($roles as  $role) {
            Role::create($role);
        }
    }
}
