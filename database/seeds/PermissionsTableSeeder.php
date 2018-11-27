<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Permission::truncate();

        Permission::create([
            'name'        => 'do_anything',
            'description' => 'One Permission to Rule Them All'
        ]);

        Permission::create([
            'name'        => 'view_permission_page',
            'description' => 'Akses halaman kelola permission'
        ]);

        Permission::create([
            'name'        => 'update_permission',
            'description' => 'Mengubah data permission'
        ]);

        foreach (config('resources') as $resource) {
            $slug = with(new $resource)->permissionKeyName();
            $name = str_replace('_', ' ', $slug);

            Permission::create([
                'name'        => "view_{$slug}_page",
                'description' => "Akses halaman kelola {$name}"
            ]);

            Permission::create([
                'name'        => "view_{$slug}_index",
                'description' => "Akses halaman kelola {$name}"
            ]);

            Permission::create([
                'name'        => "create_{$slug}",
                'description' => "Membuat {$name} baru"
            ]);

            Permission::create([
                'name'        => "update_{$slug}",
                'description' => "Mengubah data {$name}"
            ]);

            Permission::create([
                'name'        => "delete_{$slug}",
                'description' => "Menghapus data {$name}"
            ]);

            Permission::create([
                'name'        => "manage_{$slug}",
                'description' => "Melihat, membuat, mengubah, dan menghapus data {$name}"
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
