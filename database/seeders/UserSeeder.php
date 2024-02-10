<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = \App\Models\Country::where('name', 'pakistan')->first();

        \App\Models\User::insert([
            [
                'name' => 'Abdullah',
                'gender' => 'male',
                'email' => 'abdullah@gmail.com',
                'password' => Hash::make('abdullah123'),
                'country_id' => $country->id
            ],
            [
                'name' => 'Erdum Adnan',
                'gender' => 'male',
                'email' => 'erdumadnan@gmail.com',
                'password' => Hash::make('erdum123'),
                'country_id' => $country->id
            ],
            [
                'name' => 'Hamza Khalid',
                'gender' => 'male',
                'email' => 'hamzakhalid@gmail.com',
                'password' => Hash::make('hamza123'),
                'country_id' => $country->id
            ],
            [
                'name' => 'Hammad Sheikh',
                'gender' => 'male',
                'email' => 'hammadsheikh@gmail.com',
                'password' => Hash::make('hammad123'),
                'country_id' => $country->id
            ],
        ]);
    }
}
