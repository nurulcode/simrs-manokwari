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
        $superadmin = Role::create([
            'name'        => 'superadmin',
            'description' => 'Super Administrator'
        ]);

        $superadmin->givePermsissionTo('do_anything');

        $admin = Role::create([
            'name'        => 'admin',
            'description' => 'Administrator'
        ]);

        $user = Role::create([
            'name'        => 'user',
            'description' => 'Regular User'
        ]);
    }
}
