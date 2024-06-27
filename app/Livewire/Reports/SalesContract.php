<?php

namespace App\Livewire\Reports;

use App\Models\{Company, Sale};
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Livewire\Attributes\{Layout};
use Livewire\Component;

class SalesContract extends Component
{
    public Sale $sale;

    public Company $company;

    public string $city = 'Pentecoste/CE';

    public string $date = '';

    /** @var array<String> */
    public array $infos = ['MARCA/MODELO', 'ESPECIE/TIPO', 'PLACA', 'COR', 'ANO/MODELO', 'RENAVAM', 'CHASSI' , 'KILOMETRAGEM'];

    public function mount(int $id, Request $request): void
    {
        $this->date    = Carbon::create($request->only('date')['date'])->locale('pt_BR')->isoFormat('LL');
        $this->city    = $request->only('city')['city'];
        $this->sale    = Sale::find($id);
        $this->company = Company::first();
    }

    #[Layout('components.layouts.pdf')]
    public function render(): View
    {
        return view('livewire.reports.sales-contract');
    }
}
