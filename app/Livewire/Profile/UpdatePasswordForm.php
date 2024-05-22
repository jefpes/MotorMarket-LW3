<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password'         => ['required', Password::min(4), 'max:12', 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        /** @var User */
        $user = Auth::user();

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
    public function render(): View
    {
        return view('livewire.profile.update-password-form');
    }
}
