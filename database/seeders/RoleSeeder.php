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
                'is_deletetable'=> false
            ],
            [
                'name' => 'secreatary',
                'display_name' => 'Secretari@',
                'description' => 'Ayudante de la nataria',
                'is_deletetable'=> false
            ],
            [
                'name' => 'notary',
                'display_name' => 'Notari@',
                'description' => 'Jefe de negocio',
                'is_deletetable'=> false
            ],
        ];

        
        foreach ($roles as  $role) {
            Role::create($role);
        }
    }
}
