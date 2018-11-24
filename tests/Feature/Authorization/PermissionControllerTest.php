<?php

namespace Tests\Feature\Authorization;

use Tests\TestCase;
use App\Models\Permission;
use Sty\Tests\ResourceControllerTestCase;

class PermissionControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return Permission::class;
    }
}
