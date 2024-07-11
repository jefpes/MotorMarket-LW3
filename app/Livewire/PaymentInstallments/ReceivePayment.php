<?php

namespace App\Livewire\PaymentInstallments;

use App\Enums\PaymentMethod;
use App\Livewire\Forms\InstallmentForm;
use App\Models\{PaymentInstallments, Sale};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class ReceivePayment extends Component
{
    use Toast;

    public ?InstallmentForm $form;

    public bool $modal = false;

    public string $title = 'Receive Payment';

    public string $type = 'discount';

    #[On('installment::refresh')]
    public function render(): View
    {
        return view('livewire.payment-installments.receive-payment', ['payment_methods' => PaymentMethod::cases()]);
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    #[On('installment::receive')]
    public function receiving(int $id): void
    {
        $this->authorize('payment_receive');

        $this->form->setInstallment($id);

        $this->form->payment_method = PaymentMethod::DN->value;

        $this->form->payment_value = $this->form->value;

        $this->form->payment_date = now()->format('Y-m-d');

        $this->modal = true;
    }

    public function updatedType(): void
    {
        $this->form->discount  = 0;
        $this->form->surcharge = 0;
    }

    public function updatedFormDiscount(): void
    {
        $this->form->payment_value = $this->form->value - ($this->form->discount ?? 0);
    }

    public function updatedFormSurcharge(): void
    {
        $this->form->payment_value = $this->form->value + ($this->form->surcharge ?? 0);
    }

    public function save(): void
    {
        $this->authorize('payment_receive');

        $this->form->user_id = auth()->id();
        $this->form->status  = 'PAGO';
        $this->form->save();

        Sale::find($this->form->sale_id);

        if (PaymentInstallments::allPaid($this->form->sale_id)) { /* @phpstan-ignore-line */
            Sale::find($this->form->sale_id)->update(['status' => 'PAGO']);
        }

        $this->toastSuccess('Payment received successfully');
        $this->dispatch('installment::refresh');

        $this->cancel();
    }
}
