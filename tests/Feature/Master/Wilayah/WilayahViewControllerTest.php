<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;
use Sty\Tests\APITestCase;

class WilayahViewControllerTest extends TestCase
{
    use APITestCase;

    /** @test */
    public function page_not_accessible_for_guest()
    {
        $this->withExceptionHandling()
             ->get(action('Master\Wilayah\WilayahViewController'))
             ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $admin = $this->createAdmin();
        $user  = $this->createUser();

        $this
            ->signIn($user)
            ->get(action('Master\Wilayah\WilayahViewController'))
            ->assertStatus(403);

        $this->disableExceptionHandling()
            ->signIn($admin)
             ->get(action('Master\Wilayah\WilayahViewController'))
            ->assertStatus(200);
    }
}
