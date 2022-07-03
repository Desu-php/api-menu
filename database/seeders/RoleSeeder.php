<?php

namespace Database\Seeders;

use App\Helpers\SeederHelper;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        SeederHelper::firstOrCreate(Role::class,[
            ['name' => User::ADMINISTRATOR, 'guard_name' => 'web'],
            ['name' => User::CUSTOMER, 'guard_name' => 'web'],
        ]);
    }
}
