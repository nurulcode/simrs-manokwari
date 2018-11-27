<?php

namespace Tests\Feature\Authorization;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class PermissionControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Permission::class;
    }

    /** @skip **/
    public function user_can_create_a_resource()
    {
        return false;
    }

    /** @skip **/
    public function user_can_not_post_empty_data()
    {
        return false;
    }

    /** @test **/
    public function user_cannot_create_a_resource()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
             ->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertStatus(403);
    }

    /** @skip **/
    public function user_can_update_a_resource()
    {
        return false;
    }

    /** @test */
    public function user_can_update_only_a_resource_description()
    {
        $this->withExceptionHandling()
             ->signIn();

        $resource = factory($this->resource())->create();
        $new_data = factory($this->resource())->make();

        $this->putJson($resource->path, $this->beforePut($new_data))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseMissing(
            $this->resourceTable($resource),
            $this->matchDatabase($resource)
        );

        $this->assertDatabaseMissing(
            $this->resourceTable($new_data),
            $this->matchDatabase($new_data)
        );

        $this->assertDatabaseHas($this->resourceTable($resource), [
            'id'          => $resource->id,
            'name'        => $resource->name,
            'description' => $new_data->description
        ]);
    }

    /** @skip */
    public function user_can_delete_a_resource()
    {
        return false;
    }

    /** @test **/
    public function user_cannot_delete_a_resource()
    {
        $this->withExceptionHandling()
             ->signIn();

        $resource = factory($this->resource())->create();

        $this->deleteJson($resource->path)
             ->assertStatus(403);

        $this->assertDatabaseHas(
            $this->resourceTable($resource),
            $this->matchDatabase($resource)
        );
    }
}
