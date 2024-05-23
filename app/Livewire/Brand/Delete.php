<?php

namespace App\Livewire\Brand;

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
        $this->authorize('brand_delete');

        try {
            $this->form->destroy();
            $this->dispatch('brand::refresh');

            $this->icon = 'icons.success';
            $this->msg  = 'Brand Deleted';
            $this->dispatch('show-toast');

            $this->cancel();
        } catch (\Throwable $th) {
            $this->msg  = 'Brand Not Deleted';
            $this->icon = 'icons.fail';

            $this->dispatch('show-toast');

            $this->cancel();
        }
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }
}
