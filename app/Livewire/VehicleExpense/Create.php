<?php

namespace App\Livewire\VehicleExpense;

use App\Livewire\Forms\VehicleExpenseForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?VehicleExpenseForm $form;

    public bool $modal = false;

    public ?int $v_id;

    public string $title = 'Create a Expense';

    public function render(): View
    {
        return view('livewire.vehicle-expense.create');
    }

    public function cancel(): void
    {
        $this->form->reset();
        $this->reset('modal');
    }

    public function save(): void
    {
        $this->dispatch('vehicle::refresh');
        $this->form->vehicle_id = $this->v_id;
        $this->form->user_id    = auth()->id();
        $this->form->save();

        $this->icon = 'icons.success';
        $this->msg  = 'Expense Created';

        $this->dispatch('show-toast');
        $this->cancel();
    }
}
