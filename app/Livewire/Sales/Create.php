<?php

namespace App\Livewire\Sales;

use App\Enums\{PaymentMethod, Permission, StatusPayments};
use App\Livewire\Forms\{InstallmentForm, SaleForm};
use App\Models\{Client, Vehicle};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?string $header = 'New Sale';

    public ?Vehicle $vehicle;

    public ?SaleForm $sale_form;

    public ?InstallmentForm $inst_form;

    public ?float $originalPrice = 0;

    public string $type = 'discount';

    public ?float $installment_value = 0;

    public bool $inInstallments = false;

    public ?string $first_installment_date = null;

    public ?float $down_payment = 0;

    public function mount(int $id): void
    {
        $this->vehicle = Vehicle::query()
            ->with('model')
            ->find($id);

        $this->sale_form->user_id    = auth()->id();
        $this->sale_form->vehicle_id = $this->vehicle->id;

        $this->installment_value      = $this->vehicle->sale_price;
        $this->sale_form->total       = $this->vehicle->sale_price;
        $this->originalPrice          = $this->vehicle->sale_price;
        $this->sale_form->discount    = 0;
        $this->sale_form->date_sale   = now()->format('Y-m-d');
        $this->first_installment_date = now()->addMonth()->format('Y-m-d');
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
        $this->sale_form->discount  = 0;
        $this->sale_form->surcharge = 0;
        $this->updateInstallmentValue();
    }

    public function updatedSaleFormNumberInstallments(): void
    {
        $this->updateInstallmentValue();
    }

    public function updatedSaleFormDiscount(): void
    {
        $this->sale_form->total = $this->originalPrice - ($this->sale_form->discount ?? 0);

        if ($this->inInstallments) {
            $this->updateInstallmentValue();
        }
    }

    public function updatedSaleFormSurcharge(): void
    {
        $this->sale_form->total = $this->originalPrice + ($this->sale_form->surcharge ?? 0);

        if ($this->inInstallments) {
            $this->updateInstallmentValue();
        }
    }

    public function updatedSaleFormDownPayment(): void
    {
        $this->updateInstallmentValue();
    }

    public function updatedInInstallments(): void
    {
        if ($this->inInstallments) {
            $this->updateInstallmentValue();
        }
    }

    private function updateInstallmentValue(): void
    {
        $this->installment_value = ($this->sale_form->total - ($this->sale_form->down_payment ?? 0)) / ($this->sale_form->number_installments ?? 1);
    }

    public function save(): void
    {
        $this->authorize(Permission::SALE_CREATE->value);

        if ($this->vehicle->sold_date) {
            $this->toastFail('This vehicle has already been sold');

            return;
        }

        if ($this->inInstallments) {
            $this->validate(['first_installment_date' => ['required', 'date']]);

            $this->sale_form->status = StatusPayments::PN->value;
        } else {
            $this->msg  = 'Sale successfully registered';
            $this->icon = 'icons.success';

            $this->sale_form->status       = StatusPayments::PG->value;
            $this->sale_form->date_payment = now()->format('Y-m-d');
        }

        $sale = $this->sale_form->save();

        $this->vehicle->update(['sold_date' => now()->format('Y-m-d')]);

        if ($this->inInstallments) {
            $date = Date::createFromFormat('Y-m-d', $this->first_installment_date);

            for ($i = 0; $i < $this->sale_form->number_installments; $i++) {
                $this->inst_form->sale_id  = $sale->id;
                $this->inst_form->status   = StatusPayments::PN->value;
                $this->inst_form->value    = $this->installment_value;
                $this->inst_form->due_date = $date;
                $date->addMonth()->format('Y-m-d');

                $this->inst_form->save();
            }
        }

        $this->toastSuccess('Installment sale successfully registered');

        $this->redirectRoute('sales', navigate: true);
    }
}
