<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $userDefaults = [
            [
                'name' => 'Jorge',
                'midle_name'=> '',
                'first_last_name'=>'Veliz',
                'second_last_name'=>'Berzosa',
                'email' => 'jorgeconsalvacion@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'country_id' => '12'
            ],
            [
                'name' => 'Lorena',
                'midle_name'=> 'Lorena',
                'first_last_name'=>'Touma',
                'second_last_name'=>'Toums',
                'email' => 'loretouma@gmail.com',
                'identification_num' => '0996781030',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'country_id' => '12'
            ]
        ];

        foreach ($userDefaults as $user) {
            User::create($user);
        }

        $user = User::where('email','jorgeconsalvacion@gmail.com')->first();
        $role = Role::where('name','administrator')->first();
        $userLorena = User::where('email','loretouma@gmail.com')->first();
        $roleLore = Role::where('name','customer')->first();
        
        $userLorena->roles()->sync($roleLore->id);
        $user->roles()->sync($role->id);
    }
}
