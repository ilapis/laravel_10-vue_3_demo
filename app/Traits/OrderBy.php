<?php

namespace App\Traits;

trait OrderBy
{
    /**
     * @param  array<string>  $sortable
     * @return array<string, string>
     */
    private function orderBy(array $sortable): array
    {
        // Extract the sortby parameter
        $sortby = request()->input('sortby', []);
        $column = key($sortby);
        $direction = current($sortby);

        // Default to 'id' and 'asc' if the sortby parameter is not present or not valid
        if (! in_array($column, $sortable) || ! in_array($direction, [1, -1])) {
            $column = 'id';
            $direction = 'asc';
        } else {
            $direction = ($direction == 1) ? 'asc' : 'desc';
        }

        return ['column' => $column, 'direction' => $direction];
    }
}
