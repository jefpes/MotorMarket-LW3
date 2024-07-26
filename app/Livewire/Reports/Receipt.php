<?php

namespace App\Livewire\Reports;

use App\Models\{Sale};
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Computed, Layout};
use Livewire\Component;

class Receipt extends Component
{
    public Sale $sale;

    public string $city = '';

    public string $date = '';

    /** @var array<object> */
    public array $data;

    public function mount(int $id): void
    {
        $this->sale = Sale::with('client.address.city', 'vehicle.model.brand', 'vehicle.model.type', 'user.employee')->find($id);
        $this->date = Carbon::create($this->sale->date_sale)->locale('pt_BR')->isoFormat('LL');
        $this->city = request('city');
        $this->data = [
            (object) ['label' => 'PLACA', 'value' => $this->sale->vehicle->plate],
            (object) ['label' => 'MARCA/MODELO', 'value' => $this->sale->vehicle->model->brand->name],
            (object) ['label' => 'ESPECIE/TIPO', 'value' => $this->sale->vehicle->model->type->name],
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
        return view('livewire.reports.receipt');
    }

    #[Computed()]
    public function client_address(): string
    {
        return $this->sale->client->address->street . ', ' . $this->sale->client->address->number . ', ' . $this->sale->client->address->neighborhood . ' - ' . $this->sale->client->address->city->name . ' - ' . $this->sale->client->address->state;
    }
}
