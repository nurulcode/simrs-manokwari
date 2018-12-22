<?php

namespace Tests\Feature;

use Tests\TestCase;

class RawatJalanWebControllerTest extends TestCase
{
    /** @test */
    public function create_page_not_accessible_for_guest()
    {
        $this->withExceptionHandling()
             ->get(action('RawatJalanWebController@create'))
             ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $this->disableExceptionHandling()
             ->signIn()
             ->get(action('RawatJalanWebController@create'))
             ->assertStatus(200);
    }
}
