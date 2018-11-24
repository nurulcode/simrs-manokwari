<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'        => 'superadmin',
            'description' => 'Super Administrator'
        ]);

        Role::create([
            'name'        => 'user',
            'description' => 'Regular User'
        ]);
    }
}
