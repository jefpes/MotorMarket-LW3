<?php

namespace App\Livewire\Sales;

use App\Models\{Sale, Vehicle};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public ?Sale $sale = null;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.sales.delete');
    }

    #[On('sale::deleting')]
    public function deleting(int $id): void
    {
        $this->sale  = Sale::find($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize('sale_delete');

        try {
            $this->msg  = 'Sale Deleted';
            $this->icon = 'icons.success';

            if ($this->sale->number_installments > 1) {
                $this->sale->paymentInstallments()->delete();
                // dd('aqui');
            }

            Vehicle::where('id', $this->sale->vehicle_id)->update(['sold_date' => null]);
            $this->sale->delete();
            $this->dispatch('sales::refresh');

            $this->dispatch('show-toast');

            $this->modal = false;
        } catch (\Throwable $th) {
            $this->msg  = 'Sale Not Deleted';
            $this->icon = 'icons.fail';

            $this->dispatch('show-toast');

            $this->modal = false;
        }
    }
}
