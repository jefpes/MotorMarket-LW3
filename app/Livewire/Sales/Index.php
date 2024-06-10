<?php

namespace App\Livewire\Sales;

use App\Enums\StatusPayments;
use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, On, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public string $header = 'Sales';

    /** @var array<string> */
    public array $theader = ['Plate', 'Client', 'Date Sale', 'Value', 'Status', 'Installments', 'By' , 'Actions'];

    public string $filter = 'plate';

    #[Url(except: '', as: 'plate', history: true)]
    public ?string $plate = '';

    #[Url(except: '', as: 'client', history: true)]
    public ?string $client = '';

    #[Url(except: '', as: 'sts', history: true)]
    public ?string $status = '';

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 10;

    #[On('sales::refresh')]
    public function render(): View
    {
        return view('livewire.sales.index', [
            'sts' => StatusPayments::cases(),
        ]);
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

    #[Computed()]
    public function sales(): LengthAwarePaginator
    {
        return Sale::query()
        ->with('user', 'vehicle', 'client', 'paymentInstallments')
        ->when($this->plate, fn (Builder $q) => $q->whereHas('vehicle', function (Builder $q) {
            $q->where('plate', 'like', "%{$this->plate}%");
        }))
        ->when($this->client, fn (Builder $q) => $q->whereHas('client', function (Builder $q) {
            $q->where('name', 'like', "%{$this->client}%");
        }))
        ->when($this->status, fn (Builder $q) => $q->where('status', $this->status))
        ->paginate($this->perPage);
    }
}
