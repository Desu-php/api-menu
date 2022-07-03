<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SeederHelper::firstOrCreate(Currency::class, [
            ['name' => 'Сомони', 'short_code' => 'smn'],
            ['name' => 'Рубль', 'short_code' => 'rub']
        ]);
    }
}
