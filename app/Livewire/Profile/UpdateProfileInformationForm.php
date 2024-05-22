<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateProfileInformationForm extends Component
{
    public string $name = '';

    public string $email = '';

    public User $user;
    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->user  = Auth::user();
        $this->name  = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {

        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user->id)],
        ]);

        $this->user->fill($validated);

        if ($this->user->isDirty('email')) {
            $this->user->email_verified_at = null;
        }

        $this->user->save();

        $this->dispatch('profile-updated', name: $this->user->name);
    }
    public function render(): View
    {
        return view('livewire.profile.update-profile-information-form');
    }
}
