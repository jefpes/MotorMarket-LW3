<?php

namespace App\Livewire\Company;

use App\Enums\Permission;
use App\Models\{Company, Employee};
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Update extends Component
{
    use Toast;

    public string $header = "Edit Company";

    public Company $company;

    public ?int $employee_id;

    public ?string $name;

    public ?string $opened_in;

    public ?string $email;

    public ?string $phone;

    public ?string $address;

    public ?string $cnpj;

    public ?string $about;

    public ?string $logo;

    public ?string $x;

    public ?string $instagram;

    public ?string $facebook;

    public ?string $linkedin;

    public ?string $youtube;

    public ?string $whatsapp;

    public function mount(): void
    {
        $this->company = Company::find(1);

        $this->employee_id = $this->company->employee_id;
        $this->name        = $this->company->name;
        $this->email       = $this->company->email;
        $this->opened_in   = $this->company->opened_in;
        $this->phone       = $this->company->phone;
        $this->address     = $this->company->address;
        $this->cnpj        = $this->company->cnpj;
        $this->about       = $this->company->about;
        $this->logo        = $this->company->logo;
        $this->x           = $this->company->x;
        $this->instagram   = $this->company->instagram;
        $this->facebook    = $this->company->facebook;
        $this->linkedin    = $this->company->linkedin;
        $this->youtube     = $this->company->youtube;
        $this->whatsapp    = $this->company->whatsapp;
    }

    public function render(): View
    {
        return view('livewire.company.edit');
    }

    #[Computed()]
    public function employees(): Collection
    {
        return Employee::whereNull('resignation_date')->orderBy('name')->get();
    }

    public function save(): void
    {
        $this->authorize(Permission::COMPANY_UPDATE->value);

        $this->validate([
            'name'  => 'required|string',
            'email' => 'email',
        ]);

        $this->company->update([
            'employee_id' => $this->employee_id,
            'name'        => $this->name,
            'email'       => $this->email,
            'opened_in'   => $this->opened_in,
            'phone'       => $this->phone,
            'address'     => $this->address,
            'cnpj'        => $this->cnpj,
            'about'       => $this->about,
            'logo'        => $this->logo,
            'x'           => $this->x,
            'instagram'   => $this->instagram,
            'facebook'    => $this->facebook,
            'linkedin'    => $this->linkedin,
            'youtube'     => $this->youtube,
            'whatsapp'    => $this->whatsapp,
        ]);

        $this->toastSuccess('Company updated successfully');
    }
}
