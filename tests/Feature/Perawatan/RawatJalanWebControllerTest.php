<?php

namespace Tests\Feature\Perawatan;

use Tests\TestCase;

class RawatJalanWebControllerTest extends TestCase
{
    /** @test */
    public function create_page_not_accessible_for_guest()
    {
        $this->withExceptionHandling()
             ->get(action('Perawatan\RawatJalanWebController@create'))
             ->assertRedirect('/login');

        $this->withExceptionHandling()
             ->get(action('Perawatan\RawatJalanWebController@index'))
             ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $this->disableExceptionHandling()
             ->signIn()
             ->get(action('Perawatan\RawatJalanWebController@create'))
             ->assertStatus(200);

        $this->disableExceptionHandling()
             ->signIn()
             ->get(action('Perawatan\RawatJalanWebController@index'))
             ->assertStatus(200);
    }
}
