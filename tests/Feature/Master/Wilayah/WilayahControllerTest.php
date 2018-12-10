<?php

namespace Tests\Feature\Master\Wilayah;

use Tests\TestCase;

class WilayahControllerTest extends TestCase
{
    /** @test */
    public function page_not_accessible_for_guest()
    {
        $this->withExceptionHandling()
             ->get(action('Master\Wilayah\WilayahController@view'))
             ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $this->withExceptionHandling()
             ->signIn()
             ->get(action('Master\Wilayah\WilayahController@view'))
             ->assertSee('Wilayah')
             ->assertStatus(200);
    }
}
