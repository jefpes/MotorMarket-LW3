<?php

namespace App\Livewire\Sales;

use App\Enums\{Permission, StatusPayments};
use App\Models\{Sale};
use App\Traits\SortTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, On, Url, Validate};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use SortTable;
    use WithPagination;

    public string $header = 'Sales';

    public bool $modal = false;

    public bool $receipt_modal = false;

    public bool $filter_modal = false;

    public ?int $sale_id = 1;

    #[Validate('required|string|max:100')]
    public ?string $city = null;

    #[Validate('required|date')]
    public ?string $date = null;

    public bool $plate_filter = true;

    public function plateClient(): void
    {
        $this->plate_filter = !$this->plate_filter;
        $this->client       = '';
        $this->plate        = '';
    }

    #[Url(except: '', as: 'd_i', history: true)]
    public string $date_ini = '';

    #[Url(except: '', as: 'd_e', history: true)]
    public string $date_end = '';

    #[Url(except: '', as: 'plate', history: true)]
    public ?string $plate = '';

    #[Url(except: '', as: 'client', history: true)]
    public ?string $client = '';

    #[Url(except: '', as: 'sts', history: true)]
    public ?string $status = '';

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 10;

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'plate', 'head' => 'Plate'],
            (object)['field' => 'client_name', 'head' => 'Client'],
            (object)['field' => 'date_sale', 'head' => 'Sale Date'],
            (object)['field' => 'total', 'head' => 'Value'],
            (object)['field' => 'status', 'head' => 'Status'],
            (object)['field' => 'number_installments', 'head' => 'Installments'],
            (object)['field' => 'user_name', 'head' => 'By'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    public function mount(): void
    {
        $this->setInitialColumn('client_name');
    }

    #[On('sales::refresh')]
    public function render(): View
    {
        return view('livewire.sales.index', [
            'sts'        => StatusPayments::cases(),
            'permission' => Permission::class,
        ]);
    }

    public function updatedDateIni(): void
    {
        $this->resetPage();
    }

    public function updatedDateEnd(): void
    {
        $this->resetPage();
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
        return Sale::join('vehicles', 'vehicles.id', '=', 'sales.vehicle_id')
          ->join('clients', 'clients.id', '=', 'sales.client_id')
          ->join('users', 'users.id', '=', 'sales.user_id')
          ->select('sales.*', 'vehicles.plate as vehicle_plate', 'clients.name as client_name', 'users.name as user_name')
          ->when($this->plate, fn (Builder $q) => $q->where('vehicles.plate', 'like', "%{$this->plate}%"))
          ->when($this->client, fn (Builder $q) => $q->where('clients.name', 'like', "%{$this->client}%"))
          ->when($this->status, fn (Builder $q) => $q->where('sales.status', $this->status))
          ->when($this->date_ini, fn (Builder $q) => $q->where('sales.date_sale', '>=', $this->date_ini))
          ->when($this->date_end, fn (Builder $q) => $q->where('sales.date_sale', '<=', $this->date_end))
          ->orderBy($this->sortColumn, $this->sortDirection)
          ->paginate($this->perPage);
    }

    public function resetFilters(): void
    {
        $this->reset(['plate', 'client', 'status', 'date_ini', 'date_end', 'perPage']);
    }

    public function receipt(int $id): void
    {
        $this->receipt_modal = true;
        $this->sale_id       = $id;
    }

    public function issueContract(int $id): void
    {
        $this->modal   = true;
        $this->sale_id = $id;
    }
}
