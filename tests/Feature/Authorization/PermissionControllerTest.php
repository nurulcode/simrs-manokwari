<?php

namespace Tests\Feature\Authorization;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class PermissionControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Permission::class;
    }

    /** @skip **/
    public function user_can_create_a_resource()
    {
        return false;
    }

    /** @skip **/
    public function user_can_not_post_empty_data()
    {
        return false;
    }

    /** @skip **/
    public function user_can_update_a_resource()
    {
        return false;
    }

    /** @skip */
    public function user_can_delete_a_resource()
    {
        return false;
    }
}
