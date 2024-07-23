<?php

namespace App\Livewire\PaymentInstallments;

use App\Enums\{Permission, StatusPayments};
use App\Livewire\Forms\InstallmentForm;
use App\Models\{Sale};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class UndoReceivePayment extends Component
{
    use Toast;

    public bool $modal = false;

    public string $title = 'Undo Receive Payment';

    public ?InstallmentForm $form;

    public function render(): View
    {
        return view('livewire.payment-installments.undo-receive-payment');
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    #[On('installment::undo-receive')]
    public function undoReceiving(int $id): void
    {
        $this->form->setInstallment($id);

        $this->modal = true;
    }

    public function undo(): void
    {
        $this->authorize(Permission::PAYMENT_UNDO->value);

        $this->form->payment_value = null;

        $this->form->payment_date = null;

        $this->form->payment_method = null;

        $this->form->discount = null;

        $this->form->surcharge = null;

        $this->form->user_id = auth()->id();

        $this->form->status = StatusPayments::PN->value;

        $this->form->save();

        Sale::find($this->form->sale_id)->update(['status' => StatusPayments::PN->value]);

        $this->dispatch('installment::refresh');

        $this->toastSuccess('Payment undone successfully');

        $this->cancel();
    }
}
