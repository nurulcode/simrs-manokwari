<?php

use Sty\Helpers\CrudResponse;

if (!function_exists('crud_response')) {
    function crud_response($data, $state = null)
    {
        return with(new CrudResponse($data, $state))->makeResponse();
    }
}

if (!function_exists('minutes_to_jam')) {
    function minutes_to_jam(int $minutes)
    {
        $jam = $minutes / 60;
        $rem = $minutes % 60;

        return sprintf('%s.%s',
            str_pad($jam, 2, '0', STR_PAD_LEFT),
            str_pad($rem, 2, '0', STR_PAD_LEFT)
        );
    }
}
