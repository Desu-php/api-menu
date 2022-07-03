<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SeederHelper::firstOrCreate(User::class, [
            ['name' => 'Админ', 'password' => Hash::make('Passw0rd'), 'email' => 'admin@admin.com']
        ],'email', fn($model) => $model->syncRoles(User::ADMINISTRATOR));
    }
}
