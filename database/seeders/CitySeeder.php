<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
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
        SeederHelper::firstOrCreate(City::class,[
            ['name' => ['ru' => 'Худжанд']],
        ]);
    }
}