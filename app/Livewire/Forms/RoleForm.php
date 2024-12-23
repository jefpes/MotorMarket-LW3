<?php

namespace App\Livewire\Forms;

use App\Models\Role;
use Illuminate\Validation\Rule;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class RoleForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $name = '';

    public ?int $hierarchy;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name'      => ['required', 'min:3', 'max:100', Rule::unique('roles')->ignore($this->id)],
            'hierarchy' => ['required', 'integer', 'min:0', 'max:100'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        Role::updateOrCreate(
            ['id' => $this->id],
            [
                'name'      => $this->name,
                'hierarchy' => $this->hierarchy,
            ]
        );
    }

    public function destroy(): void
    {
        $r = Role::find($this->id);
        $r->abilities()->detach();
        $r->delete();
    }

    public function setRole(int $id): void
    {
        $this->fill(Role::find($id));
    }

    public function cancel(): void
    {
        $this->reset();
    }

}
