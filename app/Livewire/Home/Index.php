<?php

namespace App\Livewire\Home;

use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, Layout};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    #[Layout('components.layouts.home')]
    public function render(): View
    {
        return view('livewire.home.index');
    }

    #[Computed()]
    public function vehicles(): LengthAwarePaginator
    {
        return Vehicle::with('type', 'model', 'photos')
            ->orderBy('updated_at', 'desc')
            ->where('sold_date', '=', null)
            ->paginate();
    }
}
