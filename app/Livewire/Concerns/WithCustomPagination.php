<?php

namespace App\Livewire\Concerns;

trait WithCustomPagination
{
    public function paginationView(): string
    {
        return 'livewire.pagination.custom';
    }
}