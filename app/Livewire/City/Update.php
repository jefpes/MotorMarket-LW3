<?php

namespace App\Livewire\City;

use App\Livewire\Forms\CityForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\{On};
use Livewire\Component;

class Update extends Component
{
    use Toast;

    public ?CityForm $form;

    public bool $modal = false;

    public ?string $title = 'Edit City';

    public function render(): View
    {
        return view('livewire.city.update');
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    public function save(): void
    {
        $this->authorize('city_update');

        $this->dispatch('city::refresh');

        $this->form->save();

        $this->toastSuccess('City Updated');

        $this->cancel();
    }

    #[On('city::editing')]
    public function editing(int $id): void
    {
        $this->form->setCity($id);

        $this->modal = true;
    }
}
