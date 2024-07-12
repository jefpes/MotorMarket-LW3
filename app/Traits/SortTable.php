<?php

namespace App\Traits;

trait SortTable
{
    public string $sortDirection = 'asc';

    public string $sortColumn = 'date';

    public function doSort(string $column): void
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn    = $column;
            $this->sortDirection = 'asc';
        }
    }
}
