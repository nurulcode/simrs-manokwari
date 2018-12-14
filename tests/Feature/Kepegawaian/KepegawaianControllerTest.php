<?php

namespace Tests\Feature\Kepegawaian;

use Tests\TestCase;

class KepegawaianControllerTest extends TestCase
{
    /** @test */
    public function page_not_accessible_for_guest()
    {
        $this->withExceptionHandling()
             ->get(action('Kepegawaian\KepegawaianController@view'))
             ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $this->withExceptionHandling()
             ->signIn()
             ->get(action('Kepegawaian\KepegawaianController@view'))
             ->assertSee('Kepegawaian')
             ->assertStatus(200);
    }
}
