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

    /** @test **/
    public function can_not_deactivate_super_admin()
    {
        $this->artisan('db:seed', ['--class' => 'PermissionsTableSeeder']);
        $this->artisan('db:seed', ['--class' => 'RolesTableSeeder']);

        $resource = factory(User::class)->create();

        $resource->giveRoleAs('superadmin');

        $user     = factory(User::class)->create();

        $this->signIn($user)
             ->putJson(action('UserActivationToggleController', ['id' => $resource->id]))
             ->assertStatus(403);
    }
}
