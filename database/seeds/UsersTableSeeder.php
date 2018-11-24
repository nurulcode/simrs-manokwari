<?php

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
        factory(User::class)->create([
            'username' => 'superadmin',
            'active'   => 1
        ]);

        factory(User::class)->create([
            'username' => 'admin',
            'active'   => 1
        ]);

        factory(User::class)->create([
            'username' => 'user',
            'active'   => 1
        ]);
    }
}
