<?php

namespace App\Livewire\Company;

use App\Enums\Permission;
use App\Models\Company;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Update extends Component
{
    use Toast;

    public string $header = "Edit Company";

    public Company $company;

    public ?string $name;

    public ?string $opened_in;

    public ?string $email;

    public ?string $ceo;

    public ?string $cpf;

    public ?string $ceo_marital_status;

    public ?string $ceo_address;

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

        $this->name               = $this->company->name;
        $this->email              = $this->company->email;
        $this->opened_in          = $this->company->opened_in;
        $this->phone              = $this->company->phone;
        $this->address            = $this->company->address;
        $this->cnpj               = $this->company->cnpj;
        $this->ceo                = $this->company->ceo;
        $this->cpf                = $this->company->cpf;
        $this->ceo_marital_status = $this->company->ceo_marital_status;
        $this->ceo_address        = $this->company->ceo_address;
        $this->about              = $this->company->about;
        $this->logo               = $this->company->logo;
        $this->x                  = $this->company->x;
        $this->instagram          = $this->company->instagram;
        $this->facebook           = $this->company->facebook;
        $this->linkedin           = $this->company->linkedin;
        $this->youtube            = $this->company->youtube;
        $this->whatsapp           = $this->company->whatsapp;
    }

    public function render(): View
    {
        return view('livewire.company.edit');
    }

    public function save(): void
    {
        $this->authorize(Permission::COMPANY_UPDATE->value);

        $this->validate([
            'name'  => 'required|string',
            'email' => 'email',
        ]);

        $this->company->update([
            'name'               => $this->name,
            'email'              => $this->email,
            'opened_in'          => $this->opened_in,
            'phone'              => $this->phone,
            'address'            => $this->address,
            'ceo'                => $this->ceo,
            'cpf'                => $this->cpf,
            'ceo_marital_status' => $this->ceo_marital_status,
            'ceo_address'        => $this->ceo_address,
            'cnpj'               => $this->cnpj,
            'about'              => $this->about,
            'logo'               => $this->logo,
            'x'                  => $this->x,
            'instagram'          => $this->instagram,
            'facebook'           => $this->facebook,
            'linkedin'           => $this->linkedin,
            'youtube'            => $this->youtube,
            'whatsapp'           => $this->whatsapp,
        ]);

        $this->toastSuccess('Company updated successfully');
    }
}
