<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Show extends Component
{
    public ?Sale $sale;

    public string $header = 'Sale Details';

    public function mount(int $id): void
    {
        $this->sale = Sale::with('vehicle.model.type', 'paymentInstallments')->find($id);
    }

    public function render(): View
    {
        return view('livewire.sales.show');
    }

    #[Computed()]
    public function isArrears(): string
    {
        $installment = $this->sale
                ->paymentInstallments()
                ->where('status', 'PENDENTE')
                ->orderBy('due_date')->first();

        if ($installment->due_date < now()) {
            return 'EM ATRASO';
        } else {
            return 'EM DIA';
        }
    }

    #[Computed()]
    public function amountPaid(): float
    {
        return $this->sale->paymentInstallments->where('status', 'PAGO')->sum('payment_value');
    }

    #[Computed()]
    public function amountArrears(): float
    {
        return $this->sale->paymentInstallments->where('status', 'PENDENTE')->sum('value');
    }
}
