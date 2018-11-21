<?php

namespace Tests;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Authenticatable;
use Sty\Helpers\Tests\ExceptionToggler;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase, ExceptionToggler;

    protected $scopes = [];
    protected $header = [];
    protected $oldExceptionHandler;

    public function setUp()
    {
        parent::setUp();

        if (DB::connection() instanceof SQLiteConnection) {
            DB::statement(DB::raw('PRAGMA foreign_keys=1'));
            DB::statement(DB::raw('PRAGMA strict=ON'));
        }

        $this->withoutMiddleware(ThrottleRequests::class);
    }

    protected function signIn(Authenticatable $user = null, $driver = null)
    {
        return $this->actingAs($user ?: $this->createUser(), $driver);
    }

    public function createUser()
    {
        if (User::count() > 0) {
            return User::first();
        }

        return factory(User::class)->create();
    }
}
