<?php

namespace App\Livewire\Brand;

use App\Enums\Permission;
use App\Livewire\Forms\BrandForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?BrandForm $form;

    public bool $modal = false;

    public ?string $title = 'Create New Brand';

    public function render(): View
    {
        return view('livewire.brand.create-update');
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    #[On('brand::creating')]
    public function creating(): void
    {
        $this->modal = true;
    }

    public function save(): void
    {
        $this->authorize(Permission::BRAND_CREATE->value);

        $this->form->save();
        $this->toastSuccess('Brand created successfully');
        $this->dispatch('brand::refresh');

        $this->cancel();
    }
}
