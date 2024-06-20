<?php

namespace App\Livewire\Vehicle;

use App\Models\{Vehicle, VehiclePhoto};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Show extends Component
{
    use Toast;

    public bool $modal = false;

    public Vehicle $vehicle;

    public VehiclePhoto $photo;

    public string $header = 'Showing Vehicle';

    public function mount(int $id): void
    {
        $this->vehicle = Vehicle::with('expenses', 'model')->findOrFail($id);
    }

    #[On('vehicle::refresh')]
    public function render(): View
    {
        return view('livewire.vehicle.show');
    }

    public function cancel(): void
    {
        $this->reset('modal');
    }

    public function actions(int $id): void
    {
        $this->photo = VehiclePhoto::findOrFail($id);
        $this->modal = true;
    }

    public function destroy(): void
    {
        $this->authorize('vphoto_delete');

        try {
            Storage::delete("/vehicle_photos/" . $this->photo->photo_name);
            $this->photo->delete();
            $this->modal = false;

            $this->icon = 'icons.success';
            $this->msg  = 'Photo Deleted';

            $this->dispatch('show-toast');
        } catch (\Exception $e) {
            $this->modal = false;
            $this->icon  = 'icons.fail';
            $this->msg   = 'Failed to delete photo';
            $this->dispatch('show-toast');
        }
    }

    public function download(): BinaryFileResponse
    {
        $response = null;

        try {
            $response = response()->download($this->photo->path, $this->photo->photo_name);

            $this->icon = 'icons.success';
            $this->msg  = 'Photo Downloaded';

            $this->dispatch('show-toast');

        } catch (\Throwable $th) {
            $this->icon = 'icons.fail';
            $this->msg  = 'Download photo, failed';

            $this->dispatch('show-toast');
        }

        return $response;
    }
}
