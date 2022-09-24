<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name' => 'São Paulo',
            'state' => 'SP',
            'foundation_date' => '1554-01-25'
        ]);

        City::create([
            'name' => 'Belo Horizonte',
            'state' => 'MG',
            'foundation_date' => '1897-12-12'
        ]);

        City::create([
            'name' => 'Florianópolis',
            'state' => 'SC',
            'foundation_date' => '1673-03-23'
        ]);

        City::create([
            'name' => 'Salvador',
            'state' => 'BA',
            'foundation_date' => '1549-03-29'
        ]);

        City::create([
            'name' => 'Manaus',
            'state' => 'AM',
            'foundation_date' => '1669-10-24'
        ]);

        City::create([
            'name' => 'Distrito Federal',
            'state' => 'GO',
            'foundation_date' => '1960-04-21'
        ]);
    }
}
