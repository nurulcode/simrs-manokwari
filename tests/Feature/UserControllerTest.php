<?php

namespace Tests\Feature;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class UserControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\User::class;
    }

    public function beforePost($resource)
    {
        return array_merge($resource->toArray(), [
            'password'              => 'secret',
            'password_confirmation' => 'secret'
        ]);
    }

    public function matchDatabase($resource)
    {
        return $resource->only(['name', 'username', 'email']);
    }
}
