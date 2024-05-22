<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}
