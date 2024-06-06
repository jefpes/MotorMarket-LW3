<?php

namespace App\Livewire\PaymentInstallments;

use App\Models\PaymentInstallments;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public string $header = 'Payment Installments';

    /** @var array<string> */
    public array $theader = ['Installment', 'Due Date', 'Value', 'Status', 'Received for', 'Actions'];

    public ?Collection $installment;

    public function mount(int $id): void
    {
        $this->installment = PaymentInstallments::with('sale', 'user')->where('sale_id', $id)->get();
    }

    #[On('installment::refresh')]
    public function render(): View
    {
        return view('livewire.payment-installments.index');
    }
}
