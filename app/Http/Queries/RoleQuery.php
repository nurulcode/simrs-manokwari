<?php

namespace App\Http\Queries;

use Sty\HttpQuery;

class RoleQuery extends HttpQuery
{
    public function onlyAvailable()
    {
        return $this->builder->where('name', '<>', 'superadmin');
    }
}
