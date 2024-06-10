<?php

namespace App\Livewire\PaymentInstallments;

use App\Models\PaymentInstallments;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\{Computed, Url};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    #[Url(except: '', as: 'p', history: true)]
    public ?int $perPage = 15;

    /** @var array<string> */
    public array $theader = ['N°', 'Due Date', 'Value', 'Payment Date', 'Value Received' , 'Status', 'By', 'Actions'];

    public ?string $header = 'Installments';

    public function render(): View
    {
        return view('livewire.payment-installments.index');
    }

    #[Computed()]
    public function installments(): LengthAwarePaginator
    {
        return  PaymentInstallments::query()->with('sale', 'user')->paginate($this->perPage);
    }
}
