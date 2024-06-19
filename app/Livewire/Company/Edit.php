<?php

namespace App\Livewire\Company;

use App\Models\Company;
use App\Traits\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component
{
    use Toast;

    public string $header = "Edit Company";

    public Company $company;

    public ?string $name;

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

        $this->name      = $this->company->name;
        $this->email     = $this->company->email;
        $this->phone     = $this->company->phone;
        $this->address   = $this->company->address;
        $this->cnpj      = $this->company->cnpj;
        $this->about     = $this->company->about;
        $this->logo      = $this->company->logo;
        $this->x         = $this->company->x;
        $this->instagram = $this->company->instagram;
        $this->facebook  = $this->company->facebook;
        $this->linkedin  = $this->company->linkedin;
        $this->youtube   = $this->company->youtube;
        $this->whatsapp  = $this->company->whatsapp;
    }

    public function render(): View
    {
        return view('livewire.company.edit');
    }

    public function save(): void
    {
        $this->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required|string',
            'address'   => 'required|string',
            'cnpj'      => 'required|string',
            'about'     => 'required|string',
            'logo'      => 'required|string',
            'x'         => 'required|string',
            'instagram' => 'required|string',
            'facebook'  => 'required|string',
            'linkedin'  => 'required|string',
            'youtube'   => 'required|string',
            'whatsapp'  => 'required|string',
        ]);

        $this->company->update([
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'address'   => $this->address,
            'cnpj'      => $this->cnpj,
            'about'     => $this->about,
            'logo'      => $this->logo,
            'x'         => $this->x,
            'instagram' => $this->instagram,
            'facebook'  => $this->facebook,
            'linkedin'  => $this->linkedin,
            'youtube'   => $this->youtube,
            'whatsapp'  => $this->whatsapp,
        ]);

        $this->msg  = 'Company updated successfully!';
        $this->icon = 'icons.success';
        $this->dispatch('show-toast');
    }
}
