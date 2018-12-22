<?php

namespace Tests\Feature\Fasilitas;

use Tests\TestCase;

class FasilitasControllerTest extends TestCase
{
    /** @test */
    public function page_not_accessible_for_guest()
    {
        $this->withExceptionHandling()
             ->get(action('Fasilitas\FasilitasViewController'))
             ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $this->withExceptionHandling()
             ->signIn()
             ->get(action('Fasilitas\FasilitasViewController'))
             ->assertSee('Fasilitas')
             ->assertStatus(200);
    }
}
