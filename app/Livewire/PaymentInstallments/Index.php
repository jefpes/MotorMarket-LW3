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

    #[Url(except: '', as: 'sts', history: true)]
    public ?string $status = '';

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 15;

    public ?string $due_date_i = '';

    public ?string $due_date_f = '';

    public ?string $pay_date_i = '';

    public ?string $pay_date_f = '';

    public ?string $payment_method = '';

    /** @var array<string> */
    public array $theader = ['N°', 'Client', 'Due Date', 'Value', 'Payment Date',  'Payment Method' , 'Value Received' , 'Status', 'By', 'Actions'];

    public ?string $header = 'Installments';

    public function mount(): void
    {
        $this->due_date_i = now()->subMonth()->format('Y-m-d');
        $this->due_date_f = now()->format('Y-m-d');
    }

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
        ->when($this->due_date_i && $this->due_date_f, fn (Builder $q) => $q->whereBetween('due_date', [$this->due_date_i, $this->due_date_f]))
        ->when($this->pay_date_i && $this->pay_date_f, fn (Builder $q) => $q->whereBetween('payment_date', [$this->pay_date_i, $this->pay_date_f]))
        ->when($this->payment_method, fn (Builder $q) => $q->where('payment_method', $this->payment_method))
        ->paginate($this->perPage);
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
