<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::create([
            'name' => 'Alphaville',
            'city_id' => 1
        ]);

        District::create([
            'name' => 'Santa Efigênia',
            'city_id' => 2
        ]);

        District::create([
            'name' => 'Ingleses',
            'city_id' => 3
        ]);

        District::create([
            'name' => 'Pituba',
            'city_id' => 4
        ]);

        District::create([
            'name' => 'Parque Dez',
            'city_id' => 5
        ]);

        District::create([
            'name' => 'Lago Sul',
            'city_id' => 6
        ]);
    }
}
