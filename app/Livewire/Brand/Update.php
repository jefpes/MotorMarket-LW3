<?php

namespace App\Livewire\Brand;

use App\Enums\Permission;
use App\Livewire\Forms\BrandForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Update extends Component
{
    use Toast;

    public ?BrandForm $form;

    public bool $modal = false;

    public ?string $title = 'Edit Brand';

    public function render(): View
    {
        return view('livewire.brand.update');
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    public function save(): void
    {
        $this->authorize(Permission::BRAND_UPDATE->value);

        $this->form->save();
        $this->dispatch('brand::refresh');

        $this->toastSuccess('Brand updated successfully');
        $this->cancel();
    }

    #[On('brand::editing')]
    public function editing(int $id): void
    {
        $this->form->setBrand($id);

        $this->modal = true;
    }
}
