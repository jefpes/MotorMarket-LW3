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

            $this->toastSuccess('City Deleted');

            $this->cancel();
        } catch (\Throwable $th) {
            $this->toastFail('City not deleted');

            $this->cancel();
        }
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }
}
