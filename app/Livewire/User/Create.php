<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public UserForm $form;

    public function render(): View
    {
        return view('livewire.user.create');
    }

    public function save(): void
    {
        $this->form->save();

        $this->icon = 'icons.success';
        $this->msg  = 'User Created';
        $this->dispatch('show-toast');
        $this->form->reset();
    }
}
