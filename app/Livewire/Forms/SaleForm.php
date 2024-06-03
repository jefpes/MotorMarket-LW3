<?php

namespace App\Livewire\Forms;

use App\Models\Sale;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class SaleForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?int $user_id = null;

    public ?int $vehicle_id = null;

    public ?int $client_id = null;

    public ?string $payment_method = '';

    public ?string $status = '';

    public ?string $date_sale = '';

    public ?string $date_payment = '';

    public ?float $discount = 0;

    public ?float $surchange = 0;

    public ?float $down_payment = 0;

    public ?float $total = 0;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'user_id'        => ['required', 'exists:users,id', 'integer'],
            'vehicle_id'     => ['required', 'exists:vehicles,id', 'integer'],
            'client_id'      => ['required', 'exists:clients,id', 'integer'],
            'payment_method' => ['required', 'string', 'max:255', 'min:3'],
            'status'         => ['required', 'string', 'max:255', 'min:3'],
            'date_sale'      => ['required', 'date'],
            'date_payment'   => ['nullable', 'date'],
            'discount'       => ['required', 'numeric', 'min:0'],
            'surchange'      => ['required', 'numeric', 'min:0'],
            'down_payment'   => ['required', 'numeric', 'min:0'],
            'total'          => ['required', 'numeric', 'min:0'],
        ];
    }

    public function save(): Sale
    {
        $this->validate();
        $people = Sale::updateOrCreate(
            ['id' => $this->id],
            [
                'user_id'        => auth()->id(),
                'vehicle_id'     => $this->vehicle_id,
                'client_id'      => $this->client_id,
                'payment_method' => $this->payment_method,
                'status'         => $this->status,
                'date_sale'      => $this->date_sale,
                'date_payment'   => $this->date_payment,
                'discount'       => $this->discount,
                'surchange'      => $this->surchange,
                'down_payment'   => $this->down_payment,
                'total'          => $this->total,
            ]
        );

        return $people;
    }

    public function setSale(int $id): void
    {
        $sale                 = Sale::find($id);
        $this->id             = $sale->id;
        $this->user_id        = $sale->user_id;
        $this->vehicle_id     = $sale->vehicle_id;
        $this->client_id      = $sale->client_id;
        $this->payment_method = $sale->payment_method;
        $this->status         = $sale->status;
        $this->date_sale      = $sale->date_sale;
        $this->date_payment   = $sale->date_payment;
        $this->discount       = $sale->discount;
        $this->surchange      = $sale->surchange;
        $this->down_payment   = $sale->down_payment;
        $this->total          = $sale->total;
    }

    public function destroy(): void
    {
        Sale::find($this->id)->delete();
    }
}
