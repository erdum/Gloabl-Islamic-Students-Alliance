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
                'name' => 'Erdum Adnan',
                'gender' => true,
                'email' => 'erdumadnan@gmail.com',
                'password' => Hash::make('erdum123'),
                'country_id' => $country->id
            ],
            [
                'name' => 'Hamza Khalid',
                'gender' => true,
                'email' => 'hamzakhalid@gmail.com',
                'password' => Hash::make('hamza123'),
                'country_id' => $country->id
            ],
            [
                'name' => 'Hamza Sheikh',
                'gender' => true,
                'email' => 'hammadsheikh@gmail.com',
                'password' => Hash::make('hammad123'),
                'country_id' => $country->id
            ],
        ]);
    }
}
