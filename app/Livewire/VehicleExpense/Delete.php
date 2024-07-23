<?php

namespace App\Livewire\VehicleExpense;

use App\Enums\Permission;
use App\Livewire\Forms\{VehicleExpenseForm};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public ?VehicleExpenseForm $form;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.vehicle-expense.delete');
    }

    #[On('expense::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setExpense($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize(Permission::VEHICLE_EXPENSE_DELETE->value);
        $this->form->destroy();
        $this->dispatch('expense::refresh');
        $this->toastSuccess('Expense Deleted');

        $this->modal = false;
    }
}
