<?php

namespace App\Traits;
use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait FilterTrait {

    /**
     * add filtering.
     *
     * @param  $builder: query builder.
     * @param  $filters: array of filters.
     * @return query builder.
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
