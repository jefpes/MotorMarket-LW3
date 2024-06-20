<?php

namespace App\Livewire\VehicleExpense;

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
        $this->msg  = 'Expense Deleted';
        $this->icon = 'icons.success';
        $this->form->destroy();
        $this->dispatch('expense::refresh');

        $this->dispatch('show-toast');

        $this->modal = false;
    }
}
