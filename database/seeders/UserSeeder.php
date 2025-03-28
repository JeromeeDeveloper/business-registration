<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [

            [
                'name' => 'Jerome Porcado',
                'email' => 'porcadojerome@gmail.com',
                'password' => Hash::make('jerome123'),
                'role' => 'admin',
                'coop_id' => null, // Add if necessary
            ],

            [
                'name' => 'Jen',
                'email' => 'jm.cortes@mass-specc.coop',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'coop_id' => null, // Add if necessary
            ],

            [
                'name' => 'Mier',
                'email' => 'at.matalines@mass-specc.coop',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'coop_id' => null, // Add if necessary
            ],



            [
                'name' => 'Jerry Mocorro',
                'email' => 'jm.mocorro@mass-specc.coop',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'coop_id' => null, // Add if necessary
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
