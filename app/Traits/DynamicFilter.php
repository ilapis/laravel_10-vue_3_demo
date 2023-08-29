<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin SoftDeletes
 */
trait DynamicFilter
{
    /**
     * Applies dynamic filters to the given query based on the specified filters and options.
     *
     * @param  Builder  $query        The Eloquent query builder instance.
     * @param  array<string, string>  $filters      An associative array of filters to apply.
     * @param  array<string, string>  $keyMapping   Optional mapping of custom filter keys to database columns.
     * @param  bool  $onlyTrashed     Whether to retrieve only trashed records.
     * @param  bool  $withTrashed     Whether to include trashed records with the results.
     * @return Builder The modified query builder instance.
     */
    public function applyDynamicFilters(Builder $query, array $filters, array $keyMapping = [], bool $onlyTrashed = false, bool $withTrashed = false): Builder
    {
        foreach ($filters as $key => $value) {
            $mappedKey = $keyMapping[$key] ?? $key;
            $query->where($mappedKey, 'LIKE', '%'.$value.'%');
        }

        if (in_array(SoftDeletes::class, class_uses_recursive($query->getModel()))) {
            if ($onlyTrashed) {
                $query->onlyTrashed();
            }
            if ($withTrashed) {
                $query->withTrashed();
            }
        }

        return $query;
    }
}
