<?php

namespace App\Livewire\Auth;

use App\Livewire\Actions\Logout;
use App\Models\User;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Facades\{Auth, Session};
use Livewire\Attributes\Layout;
use Livewire\Component;

class VerifyEmail extends Component
{
    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.verify-email');
    }

    public function sendVerification(): void
    {
        /** @var User */
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}
