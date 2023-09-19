<?php

namespace Database\Seeders;

use App\Models\UserFormStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserFormStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultStatuses =  [
            [
                'code' => 'requerido',
                'name' => 'Requerido',
            ],
            [
                'code' => 'proceso',
                'name' => 'En Proceso',
            ],
            [
                'code' => 'finalizado',
                'name' => 'Finalizado',
            ]
        ];

        foreach ($defaultStatuses as $status){
            UserFormStatus::create($status);

        }
    }
}
