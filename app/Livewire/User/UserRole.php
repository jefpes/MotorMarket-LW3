<?php

namespace App\Livewire\User;

use App\Models\{Role, User};
use Illuminate\Contracts\View\View;
use Livewire\Component;

class UserRole extends Component
{
    public ?User $user;

    public Object $roles;

    public function mount(int $id): void
    {
        $this->user  = User::find($id);
        $this->roles = Role::hierarchy(auth()->user())->get();
    }
    public function render(): View
    {
        return view('livewire.user.user-role');
    }

    public function toggleRole(int $role_id): void
    {
        $this->user->roles()->toggle($role_id);
    }

}
