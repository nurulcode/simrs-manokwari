<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityTest extends TestCase
{
    /** @test */
    public function it_can_record_an_creating_resource_event()
    {
        $this->signIn();

        $resource = factory(Role::class)->create();

        $this->assertDatabaseHas('activities', [
            'subject_id'   => $resource->id,
            'subject_type' => Role::class,
            'user_id'      => Auth::id(),
            'type'         => 'created_role',
            'before'       => null,
            'after'        => $resource->toJson()
        ]);
    }

    /** @test */
    public function it_can_record_an_updating_resource_event()
    {
        $this->signIn();

        $resource = factory(Role::class)->create();

        $before   = json_encode([
            'name'        => $resource->name,
            'description' => $resource->description,
        ]);

        $resource->name        = 'Random name';
        $resource->description = 'Random description';

        $after = json_encode($resource->getDirty());

        $resource->save();

        $this->assertDatabaseHas('activities', [
            'subject_id'   => $resource->id,
            'subject_type' => Role::class,
            'user_id'      => Auth::id(),
            'type'         => 'updating_role',
            'before'       => $before,
            'after'        => $after
        ]);
    }

    /** @test */
    public function it_can_record_an_deleting_resource_event()
    {
        $this->signIn();

        $resource = factory(Role::class)->create();

        $before   = json_encode($resource->getAttributes());

        $resource->delete();

        $this->assertDatabaseHas('activities', [
            'subject_id'   => $resource->id,
            'subject_type' => Role::class,
            'user_id'      => Auth::id(),
            'type'         => 'deleted_role',
            'before'       => $before,
            'after'        => null
        ]);
    }

    /** @test */
    public function it_can_record_a_logging_in_user()
    {
        $user = factory(User::class)->create();

        Auth::login($user);

        $this->assertDatabaseHas('activities', [
            'user_id'      => $user->id,
            'subject_id'   => $user->id,
            'subject_type' => User::class,
            'type'         => 'logged_in',
        ]);
    }

    /** @test */
    public function it_can_record_a_logging_out_user()
    {
        $user = factory(User::class)->create();

        Auth::login($user);

        Auth::logout();

        $this->assertDatabaseHas('activities', [
            'user_id'      => $user->id,
            'subject_id'   => $user->id,
            'subject_type' => User::class,
            'type'         => 'logged_out',
        ]);
    }

    /** @test */
    public function an_activity_belongs_to_a_user()
    {
        $user     = factory(User::class)->create();

        Auth::login($user);

        $activity = Activity::first();

        $this->assertInstanceOf(User::class, $activity->user);
    }
}
