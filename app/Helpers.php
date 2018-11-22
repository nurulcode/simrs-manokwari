<?php

use Sty\CrudResponse;

if (!function_exists('crud_response')) {
    function crud_response($data, $state = null)
    {
        return with(new CrudResponse($data, $state))->makeResponse();
    }
}
