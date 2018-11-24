<?php

namespace Tests\Feature;

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
}
