<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SeederHelper::firstOrCreate(Country::class,[
            ['name' => ['ru' => 'Таджикистан'], 'short_name' => 'TJ'],
        ]);
    }
}
