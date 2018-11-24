<?php

namespace Tests\Feature\Authorization;

use Tests\TestCase;
use App\Models\Role;
use Sty\Tests\ResourceControllerTestCase;

class RoleControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return Role::class;
    }

    /** @test **/
    public function user_cannot_create_role_with_same_name()
    {
        $resource = factory($this->resource())->create();
        $new_data = factory($this->resource())->make(['name' => $resource->name]);

        $this->withExceptionHandling()
             ->signIn()
             ->postJson($resource->path('store'), $this->beforePost($new_data))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['name']);
    }

    /** @test **/
    public function user_can_update_role_with_same_name()
    {
        $resource = factory($this->resource())->create();
        $new_data = factory($this->resource())->make(['name' => $resource->name]);

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
}
