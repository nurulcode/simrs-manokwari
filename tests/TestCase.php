<?php

namespace Tests;

use App\Models\User;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

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

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct()
            {
                //
            }

            public function report(\Exception $e)
            {
                //
            }

            public function render($request, \Exception $e)
            {
                throw $e;
            }
        });

        return $this;
    }

    protected function withExceptionHandling()
    {
        if ($this->oldExceptionHandler) {
            $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        }

        return $this;
    }

    protected function signIn(Authenticatable $user = null, $driver = null)
    {
        return $this->actingAs($user ?: $this->createUser(), $driver);
    }

    public function createUser()
    {
        if (User::count() > 0) {
            return User::inRandomOrder()->first();
        }

        return factory(User::class)->create();
    }
}
