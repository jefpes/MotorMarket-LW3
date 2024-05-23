<?php

namespace App\Livewire\Forms;

use App\Models\Brand;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Form;

class BrandForm extends Form
{
    #[Locked]
    public ?int $id = null;

    public ?string $name = '';

    /** @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:100', Rule::unique('brands')->ignore($this->id)],
        ];
    }

    public function save(): void
    {
        $this->validate();
        Brand::updateOrCreate(
            ['id' => $this->id],
            [
                'name' => $this->name,
            ]
        );
    }

    public function destroy(): void
    {
        Brand::find($this->id)->delete();
    }

    public function setBrand(int $id): void
    {
        $brand      = Brand::find($id);
        $this->name = $brand->name;
        $this->id   = $brand->id;
    }

    public function cancel(): void
    {
        $this->reset();
    }
}
