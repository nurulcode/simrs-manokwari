<?php

namespace Tests\Feature\Perawatan;

use Tests\TestCase;
use App\Models\Perawatan\RawatInap;

class RawatInapWebControllerTest extends TestCase
{
    /** @test */
    public function create_page_not_accessible_for_guest()
    {
        $resource = factory(RawatInap::class)->create();

        $this
            // ->disableExceptionHandling()
            ->get(action('Perawatan\RawatInapWebController@create'))
            ->assertRedirect('/login');

        $this
            // ->disableExceptionHandling()
            ->get(action('Perawatan\RawatInapWebController@index'))
            ->assertRedirect('/login');

        $this
            // ->disableExceptionHandling()
            ->get(action('Perawatan\RawatInapWebController@show', $resource->id))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_access_resource_page()
    {
        $admin = $this->createAdmin();
        $user  = $this->createUser();

        $resource = factory(RawatInap::class)->create();

        $this
            // ->disableExceptionHandling()
            ->signIn($user)
            ->get(action('Perawatan\RawatInapWebController@create'))
            ->assertStatus(403);

        $this
            // ->disableExceptionHandling()
            ->signIn($user)
            ->get(action('Perawatan\RawatInapWebController@index'))
            ->assertStatus(403);

        $this
            // ->disableExceptionHandling()
            ->signIn($user)
            ->get(action('Perawatan\RawatInapWebController@show', $resource->id))
            ->assertStatus(403);

        $this
            ->disableExceptionHandling()
            ->signIn($admin)
            ->get(action('Perawatan\RawatInapWebController@create'))
            ->assertStatus(200);

        $this
            ->disableExceptionHandling()
            ->signIn($admin)
            ->get(action('Perawatan\RawatInapWebController@index'))
            ->assertStatus(200);

        $this
            ->disableExceptionHandling()
            ->signIn($admin)
            ->get(action('Perawatan\RawatInapWebController@show', $resource->id))
            ->assertStatus(200);
    }
}
