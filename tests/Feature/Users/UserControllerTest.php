<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class UserControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\User::class;
    }

    public function beforePost($resource)
    {
        return array_merge($resource->toArray(), [
            'password'              => 'secret',
            'password_confirmation' => 'secret'
        ]);
    }

    public function matchDatabase($resource)
    {
        return $resource->only(['name', 'username', 'email']);
    }

    /** @test */
    public function password_not_stored_in_plain_text()
    {
        $resource = factory($this->resource())->make();

        $this->withExceptionHandling()
             ->signIn();

        $this->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['status' => 'success'])
             ->assertStatus(201);

        $this->assertDatabaseMissing($this->resourceTable($resource), [
            'username' => $resource->username,
            'name'     => $resource->name,
            'email'    => $resource->email,
            'password' => 'secret'
        ]);
    }

    /** @test **/
    public function user_can_update_with_same_username()
    {
        $resource = factory($this->resource())->create();
        $new_data = factory($this->resource())->make([
            'username'   => $resource->username
        ]);

        $this->withExceptionHandling()
             ->signIn()
             ->putJson($resource->path, $this->beforePost($new_data))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseMissing(
            $this->resourceTable($resource),
            $this->matchDatabase($resource)
        );

        $this->assertDatabaseHas(
            $this->resourceTable($resource),
            $this->matchDatabase($new_data)
        );
    }

    /** @test **/
    public function user_can_update_a_resource_without_change_password()
    {
        $resource = factory($this->resource())->create();
        $new_data = factory($this->resource())->make();

        $this->withExceptionHandling()
             ->signIn()
             ->putJson($resource->path, array_merge($this->beforePost($new_data), [
                'password'              => '',
                'password_confirmation' => ''
             ]))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseMissing(
            $this->resourceTable($resource),
            $this->matchDatabase($resource)
        );

        $this->assertDatabaseHas($this->resourceTable($resource), array_merge(
            $this->matchDatabase($new_data), ['password' => $resource->password]
        ));
    }

    /** @test **/
    public function can_not_create_user_with_empty_password()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
             ->postJson($resource->path, array_merge($resource->toArray(), [
                'password'              => '',
                'password_confirmation' => ''
             ]))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['password'])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $resource = factory($this->resource())->make();
        $password = str_random(5);

        $this->signIn()
             ->postJson($resource->path, array_merge($resource->toArray(), [
                'password'              => $password,
                'password_confirmation' => $password
             ]))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['password'])
             ->assertStatus(422);
    }

    /** @test **/
    public function can_not_delete_super_admin()
    {
        $this->artisan('db:seed', ['--class' => 'PermissionsTableSeeder']);
        $this->artisan('db:seed', ['--class' => 'RolesTableSeeder']);

        $resource = factory($this->resource())->create();

        $resource->giveRoleAs('superadmin');

        $user     = factory($this->resource())->create();

        $this->signIn($user)
             ->deleteJson($resource->path)
             ->assertStatus(403);
    }

    /** @test **/
    public function can_not_edit_super_admin()
    {
        $this->artisan('db:seed', ['--class' => 'PermissionsTableSeeder']);
        $this->artisan('db:seed', ['--class' => 'RolesTableSeeder']);

        $resource = factory($this->resource())->create();
        $new_data = factory($this->resource())->make();

        $resource->giveRoleAs('superadmin');

        $user     = factory($this->resource())->create();

        $this->signIn($user)
             ->putJson($resource->path, $this->beforePost($new_data))
             ->assertStatus(403);
    }
}