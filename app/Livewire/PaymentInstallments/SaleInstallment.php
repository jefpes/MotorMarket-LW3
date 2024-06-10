<?php

namespace App\Livewire\PaymentInstallments;

use App\Models\PaymentInstallments;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class SaleInstallment extends Component
{
    public string $header = 'Payment Installments';

    /** @var array<string> */
    public array $theader = ['N°', 'Due Date', 'Value', 'Payment Date', 'Value Received' , 'Status', 'By', 'Actions'];

    public ?Collection $installment;

    public function mount(int $id): void
    {
        $this->installment = PaymentInstallments::with('sale', 'user')->where('sale_id', $id)->get();
    }

    #[On('installment::refresh')]
    public function render(): View
    {
        return view('livewire.payment-installments.sale-installment');
    }
}
