<?php

namespace App\Livewire\VehicleExpense;

use App\Enums\Permission;
use App\Livewire\Forms\VehicleExpenseForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{Locked, On};
use Livewire\Component;

class Edit extends Component
{
    use Toast;

    public ?VehicleExpenseForm $form;

    #[Locked]
    public int $id;

    public bool $modal = false;

    public string $title = 'Edit Expense';

    public function render(): View
    {
        return view('livewire.vehicle-expense.create-update');
    }

    #[On('expense::editing')]
    public function editing(int $id): void
    {
        $this->form->setExpense($id);
        $this->modal = true;
    }

    public function save(): void
    {
        $this->authorize(Permission::VEHICLE_EXPENSE_UPDATE->value);
        $this->dispatch('expense::refresh');

        $this->form->user_id = auth()->id();
        $this->form->save();

        $this->toastSuccess('Expense updated successfully');
        $this->reset('modal');
    }
}
