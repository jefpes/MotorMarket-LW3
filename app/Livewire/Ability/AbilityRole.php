<?php

namespace App\Livewire\Ability;

use App\Enums\Permission;
use App\Models\{Ability, Role};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AbilityRole extends Component
{
    use Toast;

    public ?Role $role;

    public Object $abilities;

    public function mount(int $id): void
    {
        $this->role      = Role::find($id);
        $this->abilities = Ability::all();
    }

    public function render(): View
    {
        return view('livewire.ability.ability-role');
    }

    public function toggleAbility(int $abilityId): void
    {
        $this->authorize(Permission::ADMIN->value);

        $result = $this->role->abilities()->toggle($abilityId);

        if ($result['attached']) {
            $this->toastSuccess('Ability Added');

            return;
        }

        if ($result['detached']) {
            $this->toastSuccess('Ability Removed');

            return;
        }
    }
}
