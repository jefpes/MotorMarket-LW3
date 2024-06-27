<?php

namespace App\Livewire\Reports;

use App\Models\{Company, Sale};
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Layout};
use Livewire\Component;

class SalesContract extends Component
{
    public Sale $sale;

    public Company $company;

    /** @var array<String> */
    public array $infos = ['MARCA/MODELO', 'ESPECIE/TIPO', 'PLACA', 'COR', 'ANO/MODELO', 'RENAVAM', 'CHASSI' , 'KILOMETRAGEM'];

    public function mount(int $id): void
    {
        $this->sale    = Sale::find($id);
        $this->company = Company::first();
    }

    #[Layout('components.layouts.pdf')]
    public function render(): View
    {
        return view('livewire.reports.sales-contract');
    }
}
