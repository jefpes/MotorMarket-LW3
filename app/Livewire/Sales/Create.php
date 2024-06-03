<?php

namespace App\Livewire\Sales;

use App\Enums\{PaymentMethod, StatusPayments};
use App\Livewire\Forms\{InstallmentForm, SaleForm};
use App\Models\{Client, Vehicle};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Create extends Component
{
    public ?string $header = 'New Sale';

    public ?Vehicle $vehicle;

    public ?SaleForm $sale_form;

    public ?InstallmentForm $inst_form;

    public ?float $originalPrice = 0;

    public ?float $discount = 0;

    public ?float $surchange = 0;

    public string $type = 'discount';

    public ?int $number_installments = 1;

    public ?float $value_installments = 0;

    public bool $deferred_payment = false;

    public ?string $date_first_installment = null;

    public ?float $down_payment = 0;

    public function mount(int $id): void
    {
        $this->vehicle = Vehicle::query()
            ->with('type', 'model')
            ->find($id);

        $this->value_installments    = $this->vehicle->sale_price;
        $this->sale_form->total      = $this->vehicle->sale_price;
        $this->originalPrice         = $this->vehicle->sale_price;
        $this->sale_form->vehicle_id = $this->vehicle->id;
        $this->sale_form->date_sale  = now()->format('Y-m-d');
        $this->sale_form->user_id    = auth()->id();
    }

    public function render(): View
    {
        return view('livewire.sales.create', ['payment_method' => PaymentMethod::cases(), 'status' => StatusPayments::cases()]);
    }

    #[Computed()]
    public function clients(): Collection
    {
        return Client::query()
            ->select('id', 'name', 'cpf')
            ->orderBy('name')
            ->get();
    }

    public function updatedType(): void
    {
        $this->discount         = 0;
        $this->surchange        = 0;
        $this->down_payment     = 0;
        $this->sale_form->total = $this->originalPrice;
    }

    public function updatednumberInstallments(): void
    {
        if($this->down_payment > 0) {
            $this->value_installments = ($this->sale_form->total - $this->down_payment) / $this->number_installments;
        } else {
            $this->value_installments = $this->sale_form->total / $this->number_installments;
        }
    }

    public function updatedDiscount(): void
    {
        $this->sale_form->total = $this->originalPrice - $this->discount;
    }

    public function updatedSurchange(): void
    {
        $this->sale_form->total = $this->originalPrice + $this->surchange;
    }

    public function updatedDownPayment(): void
    {
        $this->sale_form->down_payment = $this->down_payment;
        $this->value_installments      = ($this->sale_form->total - $this->down_payment) / $this->number_installments;
    }

    public function save(): void
    {
        if ($this->type === 'discount') {
            $this->sale_form->discount = $this->discount;
            $this->sale_form->total    = $this->originalPrice - $this->discount;
        } else {
            $this->sale_form->surchange = $this->surchange;
            $this->sale_form->total     = $this->originalPrice + $this->surchange;
        }

        if ($this->deferred_payment) {
            $this->sale_form->status = StatusPayments::PG->value;
        } else {
            $this->sale_form->status = StatusPayments::PN->value;
        }

        $this->vehicle->update(['sold_date' => now()->format('Y-m-d')]);

        $this->validate();

        $this->sale_form->save();
        // $this->redirectRoute('sales', navigate: true);
    }
}
