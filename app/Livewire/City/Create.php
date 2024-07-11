<?php

namespace App\Livewire\City;

use App\Livewire\Forms\CityForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?CityForm $form;

    public bool $modal = false;

    public ?string $title = 'Create City';

    public function render(): View
    {
        return view('livewire.city.create');
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    public function save(): void
    {
        $this->authorize('city_create');

        $this->dispatch('city::refresh');
        $this->form->save();

        $this->toastSuccess('City created successfully');
        $this->cancel();
    }
}
