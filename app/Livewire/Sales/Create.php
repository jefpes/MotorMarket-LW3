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
    public ?Vehicle $vehicle;

    public ?SaleForm $form;

    public ?float $originalPrice = 0;

    public ?float $discount = 0;

    public ?float $surchange = 0;

    public ?float $total = 0;

    public ?string $header = 'New Sale';

    public function mount(int $id): void
    {
        $this->vehicle = Vehicle::query()
            ->with('photos', 'type', 'model')
            ->find($id);

        $this->originalPrice    = $this->vehicle->sale_price;
        $this->form->vehicle_id = $this->vehicle->id;
        $this->form->user_id    = auth()->id();
    }

    public function render(): View
    {
        return view('livewire.sales.create', ['payment_method' => PaymentMethod::cases(), 'status' => StatusPayments::cases()]);
    }

    #[Computed()]
    public function clients(): Collection
    {
        return Client::query()
            ->select('id', 'name')
            ->get();
    }
}
