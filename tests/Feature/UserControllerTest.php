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
}
