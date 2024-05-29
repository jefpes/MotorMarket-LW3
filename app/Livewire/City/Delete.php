<?php

namespace App\Livewire\City;

use App\Livewire\Forms\CityForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    use Toast;

    public ?CityForm $form;

    public bool $modal = false;

    public ?string $title = 'Deleting City';

    public function render(): View
    {
        return view('livewire.city.delete');
    }

    #[On('city::deleting')]
    public function deleting(int $id): void
    {
        $this->form->setCity($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize('city_delete');

        try {
            $this->form->destroy();
            $this->dispatch('city::refresh');

            $this->icon = 'icons.success';
            $this->msg  = 'City Deleted';
            $this->dispatch('show-toast');

            $this->cancel();
        } catch (\Throwable $th) {
            $this->msg  = 'City Not Deleted';
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
