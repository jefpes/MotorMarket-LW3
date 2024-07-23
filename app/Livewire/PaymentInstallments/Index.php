<?php

namespace App\Livewire\PaymentInstallments;

use App\Enums\{PaymentMethod, Permission, StatusPayments};
use App\Models\PaymentInstallments;
use App\Traits\SortTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use SortTable;
    use WithPagination;

    public bool $modal = false;

    #[Url(except: '', as: 'sts', history: true)]
    public ?string $status = '';

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 15;

    #[Url(except: '', as: 'd-d-i', history: true)]
    public ?string $due_date_i = '';

    #[Url(except: '', as: 'd-d-e', history: true)]
    public ?string $due_date_e = '';

    #[Url(except: '', as: 'p-d-i', history: true)]
    public ?string $pay_date_i = '';

    #[Url(except: '', as: 'p-d-e', history: true)]
    public ?string $pay_date_e = '';

    #[Url(except: '', as: 'p-m', history: true)]
    public ?string $payment_method = '';

    #[Url(except: '', as: 'name', history: true)]
    public ?string $search = '';

    /** @var array<string> */
    public array $theader = ['Client', 'Due Date', 'Value', 'Payment Date',  'Payment Method' , 'Value Received' , 'Status', 'By', 'Actions'];

    public ?string $header = 'Installments';

    /** @return array<object> */
    #[Computed()]
    public function table(): array
    {
        return [
            (object)['field' => 'client_name', 'head' => 'Client'],
            (object)['field' => 'due_date', 'head' => 'Due Date'],
            (object)['field' => 'value', 'head' => 'Value'],
            (object)['field' => 'payment_date', 'head' => 'Payment Date'],
            (object)['field' => 'payment_method', 'head' => 'Payment Method'],
            (object)['field' => 'payment_value', 'head' => 'Value Received'],
            (object)['field' => 'status', 'head' => 'Status'],
            (object)['field' => 'user_name', 'head' => 'By'],
            (object)['field' => 'actions', 'head' => 'Actions'],
        ];
    }

    public function mount(): void
    {
        $this->setInitialColumn('client_name');
    }

    public function render(): View
    {
        return view('livewire.payment-installments.index', ['permission' => Permission::class, 'sts' => StatusPayments::cases(), 'payment_methods' => PaymentMethod::cases()]);
    }

    #[Computed()]
    public function installments(): LengthAwarePaginator
    {
        return  PaymentInstallments::join('sales', 'sales.id', '=', 'payment_installments.sale_id')
          ->join('clients', 'clients.id', '=', 'sales.client_id')
          ->join('users', 'users.id', '=', 'payment_installments.user_id')
          ->select('payment_installments.*', 'clients.name as client_name', 'users.name as user_name')
          ->when($this->search, fn (Builder $q) => $q->whereHas('sale.client', fn (Builder $q) => $q->where('name', 'like', "%{$this->search}%")))
          ->when($this->status, fn (Builder $q) => $q->where('payment_installments.status', $this->status))
          ->when($this->due_date_i, fn (Builder $q) => $q->where('due_date', '>=', $this->due_date_i))
          ->when($this->due_date_e, fn (Builder $q) => $q->where('due_date', '<=', $this->due_date_e))
          ->when($this->pay_date_i, fn (Builder $q) => $q->where('payment_date', '>=', $this->pay_date_i))
          ->when($this->pay_date_e, fn (Builder $q) => $q->where('payment_date', '<=', $this->pay_date_e))
          ->when($this->payment_method, fn (Builder $q) => $q->where('payment_method', $this->payment_method))
          ->orderBy($this->sortColumn, $this->sortDirection)
          ->paginate($this->perPage);
    }

    public function overdue(): void
    {
        $this->resetFilters();
        $this->status     = StatusPayments::PN->value;
        $this->due_date_e = now()->subDay()->format('Y-m-d');
    }

    public function resetFilters(): void
    {
        $this->reset(['due_date_i', 'due_date_e', 'pay_date_i', 'pay_date_e', 'payment_method', 'status']);
        $this->resetPage();
    }

    public function updatedDueDateI(): void
    {
        $this->resetPage();
    }

    public function updatedDueDateF(): void
    {
        $this->resetPage();
    }

    public function updatedPayDateI(): void
    {
        $this->resetPage();
    }

    public function updatedPayDateF(): void
    {
        $this->resetPage();
    }

    public function updatedPaymentMethod(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }
}
