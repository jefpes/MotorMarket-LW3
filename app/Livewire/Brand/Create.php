<?php

namespace App\Livewire\Brand;

use App\Livewire\Forms\BrandForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?BrandForm $form;

    public bool $modal = false;

    public ?string $title = 'Create New Brand';

    public function render(): View
    {
        return view('livewire.brand.create');
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    public function save(): void
    {
        $this->authorize('brand_create');

        $this->dispatch('brand::refresh');
        $this->form->save();

        $this->icon = 'icons.success';
        $this->msg  = 'Brand Created';
        $this->dispatch('show-toast');
        $this->cancel();
    }
}
