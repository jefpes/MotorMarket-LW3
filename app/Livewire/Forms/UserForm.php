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

    public ?string $user_name = null;

    public ?string $email = null;

    public ?string $regist_number = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        $rules = [
            'name'          => ['required', 'min:3', 'max:255'],
            'user_name'     => ['required', 'min:3', 'max:30', Rule::unique(User::class)->ignore($this->id)],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
            'regist_number' => ['required', 'size:8', Rule::unique(User::class)->ignore($this->id)],
        ];

        if (!$this->id) {
            $rules['password'] = ['required', Password::min(4), 'max:12', 'confirmed'];
        }

        return $rules;

    }

    public function setUser(int $id): void
    {
        $u                   = User::find($id);
        $this->id            = $u->id;
        $this->name          = $u->name;
        $this->user_name     = $u->user_name;
        $this->email         = $u->email;
        $this->regist_number = $u->regist_number;
        $this->password      = $u->password;
    }

    public function save(): void
    {
        $this->validate();

        User::updateOrCreate(
            ['id' => $this->id],
            [
                'name'           => $this->name,
                'user_name'      => $this->user_name,
                'email'          => $this->email,
                'regist_number'  => $this->regist_number,
                'password'       => $this->password,
                'remember_token' => Str::random(10),
            ]
        );

        //         if($this->id) {
        //     User::create(
        //         [
        //         'name'           => $this->name,
        //         'user_name'      => $this->user_name,
        //         'email'          => $this->email,
        //         'regist_number'  => $this->regist_number,
        //         'password'       => Hash::make($this->password),
        //         'remember_token' => Str::random(10),
        //         ]
        //     );
        // } else {
        //     User::updateOrCreate(
        //         ['id' => $this->id],
        //         [
        //         'name'           => $this->name,
        //         'user_name'      => $this->user_name,
        //         'email'          => $this->email,
        //         'regist_number'  => $this->regist_number,
        //         'password'       => $this->password,
        //         'remember_token' => Str::random(10),
        //             ]
        //     );
        // }

    }

    public function destroy(): void
    {
        User::find($this->id)->delete();
    }
}
