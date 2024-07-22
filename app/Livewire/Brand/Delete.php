<?php

namespace App\Livewire\Brand;

use App\Enums\Permission;
use App\Livewire\Forms\BrandForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public ?BrandForm $form;

    public bool $modal = false;

    public ?string $title = 'Deleting Brand';

    public function render(): View
    {
        return view('livewire.brand.delete');
    }

    #[On('brand::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setBrand($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize(Permission::BRAND_DELETE->value);

        try {
            $this->form->destroy();
            $this->dispatch('brand::refresh');

            $this->toastSuccess('Brand Deleted');

            $this->cancel();
        } catch (\Throwable $th) {
            $this->toastFail('Brand not deleted');
            $this->cancel();
        }
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }
}
