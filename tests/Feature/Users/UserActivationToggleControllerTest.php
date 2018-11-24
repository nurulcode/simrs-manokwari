<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\User;
use Sty\Tests\APITestCase;

class UserActivationToggleControllerTest extends TestCase
{
    use APITestCase;

    /** @test **/
    public function admin_can_toggle_user_activation()
    {
        $resource = factory(User::class)->create(['active' => false]);

        $this->withExceptionHandling()
             ->signIn()
             ->putJson(action('UserActivationToggleController', ['id' => $resource->id]))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseHas($resource->getTable(), [
            'id'       => $resource->id,
            'username' => $resource->username,
            'active'   => true
        ]);
    }
}
