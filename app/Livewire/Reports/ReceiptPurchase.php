<?php

namespace App\Livewire\Reports;

use App\Models\{Company, Vehicle};
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{ Layout};
use Livewire\Component;

class ReceiptPurchase extends Component
{
    public Vehicle $vehicle;

    public Company $company;

    public string $city = '';

    public string $date = '';

    /** @var array<object> */
    public array $data;

    public function mount(int $id): void
    {
        $this->company = Company::with('employee')->first();
        $this->vehicle = Vehicle::with('supplier.address.city', 'model.brand', 'model.type')->find($id);
        $this->date    = Carbon::create($this->vehicle->purchase_date)->locale('pt_BR')->isoFormat('LL');
        $this->city    = request('city');
        $this->data    = [
            (object) ['label' => 'PLACA', 'value' => $this->vehicle->plate],
            (object) ['label' => 'MARCA/MODELO', 'value' => $this->vehicle->model->brand->name],
            (object) ['label' => 'ESPECIE/TIPO', 'value' => $this->vehicle->model->type->name],
            (object) ['label' => 'COR', 'value' => $this->vehicle->color],
            (object) ['label' => 'ANO/MODELO', 'value' => $this->vehicle->year_one . '/' . $this->vehicle->year_two],
            (object) ['label' => 'RENAVAM', 'value' => $this->vehicle->renavam],
            (object) ['label' => 'CHASSI', 'value' => $this->vehicle->chassi],
            (object) ['label' => 'KILOMETRAGEM', 'value' => number_format($this->vehicle->km, 0, '', '.')],
        ];
    }

    #[Layout('components.layouts.pdf')]
    public function render(): View
    {
        return view('livewire.reports.receipt-purchase');
    }
}
