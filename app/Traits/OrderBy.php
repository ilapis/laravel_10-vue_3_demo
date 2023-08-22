<?php

namespace App\Traits;

trait OrderBy
{
    /**
     * Orders the results by the specified column and direction.
     *
     * @param  array<int, string>  $sortable The columns that can be sorted.
     * @param  array<string, string>  $mapping  Optional mapping of custom column names to database columns.
     * @return array<string, string|int> An associative array containing the 'column' to sort by and the 'direction' (asc or desc).
     */
    private function orderBy(array $sortable, array $mapping = []): array
    {
        // Extract the sortby parameter
        $sortby = request()->input('sortby', []);
        $column = key($sortby);
        $direction = current($sortby);

        if (isset($mapping[$column])) {
            $column = $mapping[$column];
        } else {
            if (! in_array($column, $sortable) || ! in_array($direction, [1, -1])) {
                $column = 'id';
                $direction = 'asc';
            }
        }
        $direction = ($direction == 1) ? 'asc' : 'desc';

        return ['column' => $column, 'direction' => $direction];
    }
}
