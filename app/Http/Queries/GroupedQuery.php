<?php

namespace App\Http\Queries;

trait GroupedQuery
{
    public function grouped($builder, $value = false)
    {
        if (!$value) {
            return $builder;
        }

        $search = $this->request->input('search');

        return $builder->with(['childs' => function ($query) use ($search) {
            if (!!$search) {
                $query->where('uraian', 'LIKE', '%' . $search . '%');
            }
        }])->where('parent_id', null);
    }
}
