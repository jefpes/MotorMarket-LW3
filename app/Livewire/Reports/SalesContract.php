<?php

namespace App\Livewire\Reports;

use App\Models\{Company, Sale};
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Computed, Layout};
use Livewire\Component;

class SalesContract extends Component
{
    public Sale $sale;

    public Company $company;

    public string $city = '';

    public ?string $date = null;

    /** @var array<object> */
    public array $data;

    public function mount(int $id): void
    {
        $this->date    = Carbon::create(request('date'))->locale('pt_BR')->isoFormat('LL');
        $this->city    = request('city');
        $this->sale    = Sale::with('client.address.city', 'vehicle.model.brand', 'vehicle.model.type')->find($id);
        $this->company = Company::with('employee')->first();
        $this->data    = [
            (object) ['label' => 'MARCA/MODELO', 'value' => $this->sale->vehicle->model->brand->name],
            (object) ['label' => 'ESPECIE/TIPO', 'value' => $this->sale->vehicle->model->type->name],
            (object) ['label' => 'PLACA', 'value' => $this->sale->vehicle->plate],
            (object) ['label' => 'COR', 'value' => $this->sale->vehicle->color],
            (object) ['label' => 'ANO/MODELO', 'value' => $this->sale->vehicle->year_one . '/' . $this->sale->vehicle->year_two],
            (object) ['label' => 'RENAVAM', 'value' => $this->sale->vehicle->renavam],
            (object) ['label' => 'CHASSI', 'value' => $this->sale->vehicle->chassi],
            (object) ['label' => 'KILOMETRAGEM', 'value' => number_format($this->sale->vehicle->km, 0, '', '.')],
        ];
    }

    #[Layout('components.layouts.pdf')]
    public function render(): View
    {
        return view('livewire.reports.sales-contract');
    }

    #[Computed()]
    public function ceo_address(): string
    {
        return $this->company->employee->address->street . ', ' . $this->company->employee->address->number . ', ' . $this->company->employee->address->neighborhood . ' - ' . $this->company->employee->address->city->name . ' - ' . $this->company->employee->address->state;
    }

    #[Computed()]
    public function client_address(): string
    {
        return $this->sale->client->address->street . ', ' . $this->sale->client->address->number . ', ' . $this->sale->client->address->neighborhood . ' - ' . $this->sale->client->address->city->name . ' - ' . $this->sale->client->address->state;
    }
}
