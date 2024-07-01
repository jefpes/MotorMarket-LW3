<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Company::create([
            'name'               => 'Motor Market',
            'cnpj'               => '99.999.999/9999-99',
            'ceo'                => 'João da Silva',
            'cpf'                => '999.999.999-99',
            'ceo_marital_status' => 'Solteiro(a)',
            'ceo_address'        => 'Rua das Flores, 123, Bairro das Rosas, Cidade das Cores, Estado dos Sonhos, CEP: 99999-999',
            'address'            => 'Rua das Flores, 123, Bairro das Rosas, Cidade das Cores, Estado dos Sonhos, CEP: 99999-999',
            'about'              => 'Somos uma empresa de venda de veículos, na qual presamos pela qualidade e satisfação do cliente.',
            'phone'              => '(85) 99999-9999',
            'email'              => 'google@gmail.com',
            'logo'               => 'company-logo.png',
            'x'                  => 'x.com',
            'instagram'          => 'instagram.com',
            'facebook'           => 'facebook.com',
            'linkedin'           => 'linkedin.com',
            'youtube'            => 'youtube.com',
            'whatsapp'           => 'whatsapp.com',
        ]);

    }
}
