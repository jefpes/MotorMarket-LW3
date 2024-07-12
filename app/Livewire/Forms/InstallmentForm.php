<?php

namespace App\Livewire\Forms;

use App\Models\PaymentInstallments;
use Livewire\Attributes\Locked;
use Livewire\Form;

class InstallmentForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?int $sale_id = null;

    public ?int $user_id = null;

    public ?string $due_date = null;

    public ?float $value = 0;

    public ?string $status = null;

    public ?string $payment_date = null;

    public ?float $payment_value = null;

    public ?string $payment_method = null;

    public ?float $discount = null;

    public ?float $surcharge = null;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'sale_id'        => ['required', 'integer', 'exists:sales,id'],
            'user_id'        => ['nullable', 'integer', 'exists:users,id'],
            'due_date'       => ['required', 'date'],
            'value'          => ['required', 'numeric'],
            'status'         => ['required', 'string'],
            'payment_date'   => ['nullable', 'date'],
            'payment_value'  => ['nullable', 'numeric'],
            'payment_method' => ['nullable', 'string'],
            'discount'       => ['nullable', 'numeric'],
            'surcharge'      => ['nullable', 'numeric'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        PaymentInstallments::updateOrCreate(
            ['id' => $this->id],
            [
                'sale_id'        => $this->sale_id,
                'user_id'        => $this->user_id,
                'due_date'       => $this->due_date,
                'value'          => $this->value,
                'status'         => $this->status,
                'payment_date'   => $this->payment_date,
                'payment_value'  => $this->payment_value,
                'payment_method' => $this->payment_method,
                'discount'       => $this->discount,
                'surcharge'      => $this->surcharge,
            ]
        );
    }

    public function setInstallment(int $id): void
    {
        $this->fill(PaymentInstallments::find($id));
    }

    public function destroy(): void
    {
        PaymentInstallments::destroy($this->id);
    }
}
