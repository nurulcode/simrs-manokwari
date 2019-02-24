<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();

        DB::table('permission_role')->truncate();

        with(Role::create([
                'name'        => 'superadmin',
                'description' => 'Super Administrator'
        ]))->givePermsissionTo('do_anything');

        with(Role::create([
            'name'        => 'operator_registrasi',
            'description' => 'Operator Registrasi'
        ]))->givePermsissionTo('manage_registrasi');

        with(Role::create([
            'name'        => 'operator_rawat_jalan',
            'description' => 'Operator Rawat Jalan'
        ]))->givePermsissionTo('manage_rawat_jalan');

        with(Role::create([
            'name'        => 'operator_rawat_darurat',
            'description' => 'Operator Rawat Darurat'
        ]))->givePermsissionTo('manage_rawat_darurat');

        with(Role::create([
            'name'        => 'operator_rawat_inap',
            'description' => 'Operator Rawat Inap'
        ]))->givePermsissionTo('manage_rawat_inap');

        Schema::enableForeignKeyConstraints();
    }
}
