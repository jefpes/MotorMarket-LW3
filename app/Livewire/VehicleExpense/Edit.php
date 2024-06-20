<?php

namespace App\Livewire\VehicleExpense;

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
        return view('livewire.vehicle-expense.edit');
    }

    #[On('expense::editing')]
    public function editing(int $id): void
    {
        $this->form->setExpense($id);
        $this->modal = true;
    }

    public function save(): void
    {
        $this->dispatch('expense::refresh');
        $this->form->user_id = auth()->id();
        $this->form->save();

        $this->icon = 'icons.success';

        $this->msg = 'Expense Updated';

        $this->dispatch('show-toast');
        $this->reset('modal');
    }
}
