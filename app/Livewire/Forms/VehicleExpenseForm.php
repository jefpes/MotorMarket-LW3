<?php

namespace App\Livewire\Forms;

use App\Models\{VehicleExpense};
use Livewire\Attributes\{Locked};
use Livewire\Form;

class VehicleExpenseForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $date;

    public ?string $value;

    public ?int $vehicle_id;

    public ?int $user_id;

    public ?string $description;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'date'        => ['required', 'date'],
            'value'       => ['required', 'numeric'],
            'vehicle_id'  => ['required', 'exists:vehicles,id', 'integer'],
            'user_id'     => ['required', 'exists:users,id', 'integer'],
            'description' => ['required', 'min:3', 'max:100'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        VehicleExpense::updateOrCreate(
            ['id' => $this->id],
            [
                'date'        => $this->date,
                'value'       => $this->value,
                'vehicle_id'  => $this->vehicle_id,
                'user_id'     => $this->user_id,
                'description' => $this->description,
            ]
        );
    }

    public function destroy(): void
    {
        VehicleExpense::find($this->id)->delete();
    }

    public function setExpense(int $id): void
    {
        $expense           = VehicleExpense::find($id);
        $this->id          = $expense->id;
        $this->date        = $expense->date;
        $this->value       = (string) $expense->value;
        $this->vehicle_id  = $expense->vehicle_id;
        $this->user_id     = $expense->user_id;
        $this->description = $expense->description;
    }

    public function cancel(): void
    {
        $this->reset();
    }

}
