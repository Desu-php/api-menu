<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        SeederHelper::updateOrCreate(Language::class, [
            ['name' => 'Русский', 'key' => 'ru', 'code' => 'ру'],
            ['name' => 'Английский', 'key' => 'en', 'code' => 'en'],
        ], 'key');
    }
}
