<?php

namespace App\Livewire\Sales;

use App\Enums\{PaymentMethod, StatusPayments};
use App\Livewire\Forms\SaleForm;
use App\Models\{Client, Vehicle};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Create extends Component
{
    public ?string $header = 'New Sale';

    public ?Vehicle $vehicle;

    public ?SaleForm $form;

    public ?float $originalPrice = 0;

    public ?float $discount = 0;

    public ?float $surchange = 0;

    public string $type = 'discount';

    public ?int $number_installments = 1;

    public ?float $value_installments = 0;

    public function mount(int $id): void
    {
        $this->vehicle = Vehicle::query()
            ->with('type', 'model')
            ->find($id);

        $this->value_installments = $this->vehicle->sale_price;
        $this->originalPrice      = $this->vehicle->sale_price;
        $this->form->vehicle_id   = $this->vehicle->id;
        $this->form->date_sale    = now()->format('Y-m-d');
        $this->form->date_payment = now()->format('Y-m-d');
        $this->form->user_id      = auth()->id();
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
        $this->discount    = 0;
        $this->surchange   = 0;
        $this->form->total = $this->originalPrice;
    }

    public function updatednumberInstallments(): void
    {
        $this->value_installments = $this->form->total / $this->number_installments;
    }

    public function updatedDiscount(): void
    {
        $this->form->total = $this->originalPrice - $this->discount;
    }

    public function updatedSurchange(): void
    {
        $this->form->total = $this->originalPrice + $this->surchange;
    }

    public function save(): void
    {
        if ($this->type === 'discount') {
            $this->form->discount = $this->discount;
            $this->form->total    = $this->originalPrice - $this->discount;
        } else {
            $this->form->surchange = $this->surchange;
            $this->form->total     = $this->originalPrice + $this->surchange;
        }

        switch ($this->form->payment_method) {
            case PaymentMethod::AV->value:
            case PaymentMethod::CD->value:
            case PaymentMethod::CC->value:
            case PaymentMethod::DP->value:
            case PaymentMethod::DN->value:
            case PaymentMethod::PD->value:
                $this->form->status = StatusPayments::PG->value;

                break;

            case PaymentMethod::CH->value:
            case PaymentMethod::CP->value:
            case PaymentMethod::BB->value:
                $this->form->status = StatusPayments::PN->value;

                break;
        }

        $this->vehicle->update(['sold_date' => now()->format('Y-m-d')]);

        $this->validate();

        $this->form->save();
        // $this->redirectRoute('sales', navigate: true);
    }
}
