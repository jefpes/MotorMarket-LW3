<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public string $header = 'Sales';

    /** @var array<string> */
    public array $theader = ['Name', 'User', 'Register Number', 'E-Mail', 'Actions'];

    public string $filter = 'plate';

    #[Url(except: '', as: 'plate', history: true)]
    public ?string $plate = '';

    #[Url(except: '', as: 'client', history: true)]
    public ?string $client = '';

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 10;

    #[On('sales::refresh')]
    public function render(): View
    {
        return view('livewire.sales.index');
    }

    public function updatedFilter(): void
    {
        $this->resetPage();
        $this->plate  = '';
        $this->client = '';
    }

    public function updatedPlate(): void
    {
        $this->resetPage();
    }

    public function updatedClient(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    #[Computed('sales')]
    public function sales(): LengthAwarePaginator
    {
        return Sale::query()
        ->with('user', 'vehicle', 'client', 'paymentInstallments')
        ->when($this->plate, function ($query, $plate) {
            $query->whereHas('vehicle', function ($query) use ($plate) {
                $query->where('plate', 'like', "%$plate%");
            });
        })->when($this->client, function ($query, $client) {
            $query->whereHas('client', function ($query) use ($client) {
                $query->where('name', 'like', "%$client%");
            });
        })->paginate($this->perPage);
    }
}
