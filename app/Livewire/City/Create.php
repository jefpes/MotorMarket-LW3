<?php

namespace App\Livewire\City;

use App\Enums\Permission;
use App\Livewire\Forms\CityForm;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    use Toast;

    public ?CityForm $form;

    public bool $modal = false;

    public ?string $title = 'Create City';

    public function render(): View
    {
        return view('livewire.city.create-update');
    }

    public function cancel(): void
    {
        $this->reset('modal');
        $this->form->reset();
    }

    #[On('city::creating')]
    public function creating(): void
    {
        $this->modal = true;
    }

    public function save(): void
    {
        $this->authorize(Permission::CITY_CREATE->value);

        $this->dispatch('city::refresh');
        $this->form->save();

        $this->toastSuccess('City created successfully');
        $this->cancel();
    }
}
