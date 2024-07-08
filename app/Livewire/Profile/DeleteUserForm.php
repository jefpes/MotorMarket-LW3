<?php

namespace App\Livewire\Profile;

use App\Livewire\Actions\Logout;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeleteUserForm extends Component
{
    public string $password = '';

    public bool $modal = false;

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        /** @var User */
        $user = Auth::user();

        $user->roles()->detach();

        $user->update(['active' => false]);

        tap(Auth::user(), $logout(...));

        $this->redirect('/', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.profile.delete-user-form');
    }
}
