<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        Permission::create([
            'name'        => 'permission_ring',
            'description' => 'One Permission to Rule Them All'
        ]);

        Permission::create([
            'name'        => 'permission_view_page',
            'description' => 'Akses halaman kelola permission'
        ]);

        Permission::create([
            'name'        => 'permission_update',
            'description' => 'Mengubah data permission'
        ]);

        foreach (config('resources') as $resource) {
            $slug = with(new $resource)->permissionSlug();

            Permission::create([
                'name'        => $slug . '_view_page',
                'description' => 'Akses halaman kelola ' . str_replace('_', ' ', $slug)
            ]);

            Permission::create([
                'name'        => $slug . '_create',
                'description' => 'Membuat ' . str_replace('_', ' ', $slug) . ' baru'
            ]);

            Permission::create([
                'name'        => $slug . '_update',
                'description' => 'Mengubah data ' . str_replace('_', ' ', $slug)
            ]);

            Permission::create([
                'name'        => $slug . '_delete',
                'description' => 'Menghapus data ' . str_replace('_', ' ', $slug)
            ]);
        }
    }
}
