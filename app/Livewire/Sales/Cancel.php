<?php

namespace App\Livewire\Sales;

use App\Enums\StatusPayments;
use App\Models\{Sale, Vehicle};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Cancel extends Component
{
    use Toast;

    public ?Sale $sale = null;

    public bool $modal = false;

    public ?float $reimbursement = null;

    public function render(): View
    {
        return view('livewire.sales.cancel');
    }

    #[On('sale::canceling')]
    public function canceling(int $id): void
    {
        $this->sale  = Sale::with('paymentInstallments')->find($id);
        $this->modal = true;
    }

    public function cancel(): void
    {
        $this->authorize('sale_cancel');

        if($this->sale->date_cancel !== null) {
            $this->toastFail('Sale already cancelled');

            $this->modal = false;

            return;
        }

        try {

            if ($this->sale->number_installments > 1) {
                $this->sale->paymentInstallments->each(function ($installment) {
                    $installment->update(['status' => StatusPayments::CN->value, 'user_id' => auth()->id()]);
                });
            }

            Vehicle::where('id', $this->sale->vehicle_id)->update(['sold_date' => null]);

            if ($this->reimbursement) {
                $this->sale->update(['status' => StatusPayments::RF->value, 'date_cancel' => now()->format('Y-m-d'), 'reimbursement' => $this->reimbursement, 'user_id' => auth()->id()]);
            }

            if (!$this->reimbursement) {
                $this->sale->update(['status' => StatusPayments::CN->value, 'date_cancel' => now()->format('Y-m-d'), 'user_id' => auth()->id()]);
            }
            $this->dispatch('sales::refresh');

            $this->toastSuccess('Sale cancelled successfully');

            $this->modal = false;
        } catch (\Throwable $th) {
            $this->msg  = 'Sale Not Cancelled';
            $this->icon = 'icons.fail';

            $this->dispatch('show-toast');

            $this->modal = false;
        }
    }
}
