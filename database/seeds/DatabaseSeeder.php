<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MasterDataSeeder::class);
        $this->call(FasilitasSeeder::class);
        $this->call(PivotTableSeeder::class);
        // $this->call(PasienTableSeeder::class);
    }
}
