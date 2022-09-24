<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kenan Fintelman',
            'email' => 'kenanfintelman123@hotmail.com',
            'password' => bcrypt('secret123')
        ]);

        User::create([
            'name' => 'User Test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('secret123')
        ]);
    }
}
