<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Sty\Tests\APITestCase;

class UserRoleControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function user_can_assign_role_to_new_user()
    {
        $roles    = factory(Role::class, 5)->create();
        $resource = factory(User::class)->make();
        $password = str_random(99);

        $this->signIn()
             ->postJson($resource->path('store'), array_merge(
                $resource->toArray(), [
                    'password'              => $password,
                    'password_confirmation' => $password,
                    'roles'                 => $roles
                ]
             ))
             ->assertJson(['status' => 'success'])
             ->assertStatus(201);

        $this->assertDatabaseHas($resource->getTable(), [
            'username' => $resource->username,
            'name'     => $resource->name,
            'email'    => $resource->email,
        ]);

        $user = User::where('username', $resource->username)->firstOrFail();

        $this->assertDatabaseHas('role_user', [
            'user_id' => $user->id,
            'role_id' => $roles->random()->id
        ]);
    }

    /** @test */
    public function user_can_assign_role_to_existing_user()
    {
        $roles    = factory(Role::class, 5)->create();
        $resource = factory(User::class)->create();

        $password = str_random(99);

        $this->signIn()
             ->putJson($resource->path, array_merge(
                $resource->toArray(), [
                    'password'              => $password,
                    'password_confirmation' => $password,
                    'roles'                 => $roles
                ]
             ))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseHas('role_user', [
            'user_id' => $resource->id,
            'role_id' => $roles->random()->id
        ]);
    }

    /** @test */
    public function user_has_roles_in_resource_collection()
    {
        $resource = factory(User::class)->create();
        $roles    = factory(Role::class, 10)->create();

        $resource->roles()->sync(
            $roles->map(function ($value) {
                return $value->id;
            })->toArray()
        );

        $this->signIn()
             ->getJson($resource->path('index'))
             ->assertJson(['data' => []])
             ->assertJsonStructure([
                'data'  => ['*' => ['path', 'roles']]
              ])
             ->assertStatus(200);
    }
}
