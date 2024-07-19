<?php

namespace App\Livewire\PaymentInstallments;

use App\Enums\{PaymentMethod, StatusPayments};
use App\Models\PaymentInstallments;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
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

    public ?string $payment_method = '';

    /** @var array<string> */
    public array $theader = ['N°', 'Client', 'Due Date', 'Value', 'Payment Date',  'Payment Method' , 'Value Received' , 'Status', 'By', 'Actions'];

    public ?string $header = 'Installments';

    public function render(): View
    {
        return view('livewire.payment-installments.index', ['sts' => StatusPayments::cases(), 'payment_methods' => PaymentMethod::cases()]);
    }

    #[Computed()]
    public function installments(): LengthAwarePaginator
    {
        return  PaymentInstallments::query()
          ->with('sale', 'user')
          ->orderBy('due_date')
          ->when($this->status, fn (Builder $q) => $q->where('status', $this->status))
          ->when($this->due_date_i, fn (Builder $q) => $q->where('due_date', '>=', $this->due_date_i))
          ->when($this->due_date_e, fn (Builder $q) => $q->where('due_date', '<=', $this->due_date_e))
          ->when($this->pay_date_i, fn (Builder $q) => $q->where('payment_date', '>=', $this->pay_date_i))
          ->when($this->pay_date_e, fn (Builder $q) => $q->where('payment_date', '<=', $this->pay_date_e))
          ->when($this->payment_method, fn (Builder $q) => $q->where('payment_method', $this->payment_method))
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
