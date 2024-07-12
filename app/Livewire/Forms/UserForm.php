<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\{Locked};
use Livewire\Form;

class UserForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $name = null;

    public ?string $email = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public ?int $employee_id = null;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        $rules = [
            'name'        => ['required', 'min:3', 'max:255'],
            'email'       => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
            'employee_id' => ['required', 'integer', 'exists:employees,id', Rule::unique(User::class)->ignore($this->id)],
        ];

        if (!$this->id) {
            $rules['password'] = ['required', Password::min(4), 'max:12', 'confirmed'];
        }

        return $rules;

    }

    public function setUser(int $id): void
    {
        $this->fill(User::withTrashed()->find($id));
    }

    public function save(): User
    {
        $this->validate();

        return User::updateOrCreate(
            ['id' => $this->id],
            [
                'name'           => $this->name,
                'email'          => $this->email,
                'password'       => $this->password,
                'remember_token' => Str::random(10),
                'employee_id'    => $this->employee_id,
            ]
        );
    }

    public function destroy(): void
    {
        User::find($this->id)->delete();
    }
}
