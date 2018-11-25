<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::withoutGlobalScope('nosuper')
            ->where('name', 'superadmin')
            ->firstOrFail();

        factory(User::class)->create([
            'name'     => 'Super Administrator',
            'email'    => 'superadmin@mail.com',
            'username' => 'superadmin',
            'active'   => true
        ])->giveRoleAs($superadmin);

        factory(User::class)->create([
            'username' => 'admin',
            'active'   => true
        ]);

        factory(User::class)->create([
            'username' => 'user',
            'active'   => true
        ]);
    }
}
