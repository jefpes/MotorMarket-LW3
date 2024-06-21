<?php

namespace Database\Seeders;

use App\Models\{Vehicle};
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'purchase_date'    => '2024-05-24',
            'purchase_price'   => 40000.00,
            'sale_price'       => 48000.00,
            'vehicle_model_id' => 26,
            'year_one'         => 2014,
            'year_two'         => 2014,
            'km'               => 34000,
            'color'            => 'Branco',
            'plate'            => 'AAA-0001',
            'chassi'           => '000000001',
            'renavan'          => '000000001',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'corrola-branco-2014-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-branco-2014-1.webp',
                'path'       => 'storage/vehicle_photos/corrola-branco-2014-1.webp',
            ],
            [
                'photo_name' => 'corrola-branco-2014-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-branco-2014-2.webp',
                'path'       => 'storage/vehicle_photos/corrola-branco-2014-2.webp',
            ],
            [
                'photo_name' => 'corrola-branco-2014-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-branco-2014-3.webp',
                'path'       => 'storage/vehicle_photos/corrola-branco-2014-3.webp',
            ],
            [
                'photo_name' => 'corrola-branco-2014-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-branco-2014-4.webp',
                'path'       => 'storage/vehicle_photos/corrola-branco-2014-4.webp',
            ],
            [
                'photo_name' => 'corrola-branco-2014-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-branco-2014-5.webp',
                'path'       => 'storage/vehicle_photos/corrola-branco-2014-5.webp',
            ],
            [
                'photo_name' => 'corrola-branco-2014-6.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-branco-2014-6.webp',
                'path'       => 'storage/vehicle_photos/corrola-branco-2014-6.webp',
            ],
            [
                'photo_name' => 'corrola-branco-2014-7.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-branco-2014-7.webp',
                'path'       => 'storage/vehicle_photos/corrola-branco-2014-7.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-04-02',
            'purchase_price'   => 11000.00,
            'sale_price'       => 15000.00,
            'vehicle_model_id' => 33,
            'year_one'         => 2015,
            'year_two'         => 2015,
            'km'               => 10123,
            'color'            => 'Branco',
            'plate'            => 'AAA-0002',
            'chassi'           => '000000002',
            'renavan'          => '000000002',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'bros-branca-2015-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-branca-2015-1.webp',
                'path'       => 'storage/vehicle_photos/bros-branca-2015-1.webp',
            ],
            [
                'photo_name' => 'bros-branca-2015-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-branca-2015-2.webp',
                'path'       => 'storage/vehicle_photos/bros-branca-2015-2.webp',
            ],
            [
                'photo_name' => 'bros-branca-2015-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-branca-2015-3.webp',
                'path'       => 'storage/vehicle_photos/bros-branca-2015-3.webp',
            ],
            [
                'photo_name' => 'bros-branca-2015-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-branca-2015-4.webp',
                'path'       => 'storage/vehicle_photos/bros-branca-2015-4.webp',
            ],
            [
                'photo_name' => 'bros-branca-2015-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-branca-2015-5.webp',
                'path'       => 'storage/vehicle_photos/bros-branca-2015-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-05-01',
            'purchase_price'   => 10500.00,
            'sale_price'       => 14000.00,
            'vehicle_model_id' => 33,
            'year_one'         => 2015,
            'year_two'         => 2015,
            'km'               => 16000,
            'color'            => 'Preta',
            'plate'            => 'AAA-0003',
            'chassi'           => '000000003',
            'renavan'          => '000000003',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'bros-preta-2015-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-preta-2015-1.webp',
                'path'       => 'storage/vehicle_photos/bros-preta-2015-1.webp',
            ],
            [
                'photo_name' => 'bros-preta-2015-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-preta-2015-2.webp',
                'path'       => 'storage/vehicle_photos/bros-preta-2015-2.webp',
            ],
            [
                'photo_name' => 'bros-preta-2015-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-preta-2015-3.webp',
                'path'       => 'storage/vehicle_photos/bros-preta-2015-3.webp',
            ],
            [
                'photo_name' => 'bros-preta-2015-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-preta-2015-4.webp',
                'path'       => 'storage/vehicle_photos/bros-preta-2015-4.webp',
            ],
            [
                'photo_name' => 'bros-preta-2015-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-preta-2015-5.webp',
                'path'       => 'storage/vehicle_photos/bros-preta-2015-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-05-01',
            'purchase_price'   => 10700.00,
            'sale_price'       => 14000.00,
            'vehicle_model_id' => 33,
            'year_one'         => 2015,
            'year_two'         => 2015,
            'km'               => 16000,
            'color'            => 'Vermelha',
            'plate'            => 'AAA-0004',
            'chassi'           => '000000004',
            'renavan'          => '000000004',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'bros-vermelha-2015-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-vermelha-2015-1.webp',
                'path'       => 'storage/vehicle_photos/bros-vermelha-2015-1.webp',
            ],
            [
                'photo_name' => 'bros-vermelha-2015-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-vermelha-2015-2.webp',
                'path'       => 'storage/vehicle_photos/bros-vermelha-2015-2.webp',
            ],
            [
                'photo_name' => 'bros-vermelha-2015-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-vermelha-2015-3.webp',
                'path'       => 'storage/vehicle_photos/bros-vermelha-2015-3.webp',
            ],
            [
                'photo_name' => 'bros-vermelha-2015-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-vermelha-2015-4.webp',
                'path'       => 'storage/vehicle_photos/bros-vermelha-2015-4.webp',
            ],
            [
                'photo_name' => 'bros-vermelha-2015-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/bros-vermelha-2015-5.webp',
                'path'       => 'storage/vehicle_photos/bros-vermelha-2015-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-06-01',
            'purchase_price'   => 17000.00,
            'sale_price'       => 23000.00,
            'vehicle_model_id' => 37,
            'year_one'         => 2012,
            'year_two'         => 2012,
            'km'               => 41000,
            'color'            => 'Preto',
            'plate'            => 'AAA-0005',
            'renavan'          => '000000005',
            'chassi'           => '000000005',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'celta-preto-2012-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-preto-2012-1.webp',
                'path'       => 'storage/vehicle_photos/celta-preto-2012-1.webp',
            ],
            [
                'photo_name' => 'celta-preto-2012-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-preto-2012-2.webp',
                'path'       => 'storage/vehicle_photos/celta-preto-2012-2.webp',
            ],
            [
                'photo_name' => 'celta-preto-2012-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-preto-2012-3.webp',
                'path'       => 'storage/vehicle_photos/celta-preto-2012-3.webp',
            ],
            [
                'photo_name' => 'celta-preto-2012-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-preto-2012-4.webp',
                'path'       => 'storage/vehicle_photos/celta-preto-2012-4.webp',
            ],
            [
                'photo_name' => 'celta-preto-2012-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-preto-2012-5.webp',
                'path'       => 'storage/vehicle_photos/celta-preto-2012-5.webp',
            ],
            [
                'photo_name' => 'celta-preto-2012-6.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-preto-2012-6.webp',
                'path'       => 'storage/vehicle_photos/celta-preto-2012-6.webp',
            ],
            [
                'photo_name' => 'celta-preto-2012-7.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-preto-2012-7.webp',
                'path'       => 'storage/vehicle_photos/celta-preto-2012-7.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-04-03',
            'purchase_price'   => 19000.00,
            'sale_price'       => 23000.00,
            'vehicle_model_id' => 37,
            'year_one'         => 2013,
            'year_two'         => 2013,
            'km'               => 23000,
            'color'            => 'Vermelho',
            'plate'            => 'AAA-0006',
            'chassi'           => '000000006',
            'renavan'          => '000000006',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'celta-vermelho-2013-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-vermelho-2013-1.webp',
                'path'       => 'storage/vehicle_photos/celta-vermelho-2013-1.webp',
            ],
            [
                'photo_name' => 'celta-vermelho-2013-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-vermelho-2013-2.webp',
                'path'       => 'storage/vehicle_photos/celta-vermelho-2013-2.webp',
            ],
            [
                'photo_name' => 'celta-vermelho-2013-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-vermelho-2013-3.webp',
                'path'       => 'storage/vehicle_photos/celta-vermelho-2013-3.webp',
            ],
            [
                'photo_name' => 'celta-vermelho-2013-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-vermelho-2013-4.webp',
                'path'       => 'storage/vehicle_photos/celta-vermelho-2013-4.webp',
            ],
            [
                'photo_name' => 'celta-vermelho-2013-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-vermelho-2013-5.webp',
                'path'       => 'storage/vehicle_photos/celta-vermelho-2013-5.webp',
            ],
            [
                'photo_name' => 'celta-vermelho-2013-6.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-vermelho-2013-6.webp',
                'path'       => 'storage/vehicle_photos/celta-vermelho-2013-6.webp',
            ],
            [
                'photo_name' => 'celta-vermelho-2013-7.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/celta-vermelho-2013-7.webp',
                'path'       => 'storage/vehicle_photos/celta-vermelho-2013-7.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-03-01',
            'purchase_price'   => 90000.00,
            'sale_price'       => 110000.00,
            'vehicle_model_id' => 26,
            'year_one'         => 2021,
            'year_two'         => 2021,
            'km'               => 21021,
            'color'            => 'Preto',
            'plate'            => 'AAA-0007',
            'renavan'          => '000000007',
            'chassi'           => '000000007',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'corrola-preto-2021-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-preto-2021-1.webp',
                'path'       => 'storage/vehicle_photos/corrola-preto-2021-1.webp',
            ],
            [
                'photo_name' => 'corrola-preto-2021-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-preto-2021-2.webp',
                'path'       => 'storage/vehicle_photos/corrola-preto-2021-2.webp',
            ],
            [
                'photo_name' => 'corrola-preto-2021-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-preto-2021-3.webp',
                'path'       => 'storage/vehicle_photos/corrola-preto-2021-3.webp',
            ],
            [
                'photo_name' => 'corrola-preto-2021-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-preto-2021-4.webp',
                'path'       => 'storage/vehicle_photos/corrola-preto-2021-4.webp',
            ],
            [
                'photo_name' => 'corrola-preto-2021-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-preto-2021-5.webp',
                'path'       => 'storage/vehicle_photos/corrola-preto-2021-5.webp',
            ],
            [
                'photo_name' => 'corrola-preto-2021-6.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-preto-2021-6.webp',
                'path'       => 'storage/vehicle_photos/corrola-preto-2021-6.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-03-22',
            'purchase_price'   => 70000.00,
            'sale_price'       => 81000.00,
            'vehicle_model_id' => 26,
            'year_one'         => 2016,
            'year_two'         => 2017,
            'km'               => 40123,
            'color'            => 'Vermelho',
            'plate'            => 'AAA-0008',
            'renavan'          => '000000008',
            'chassi'           => '000000008',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'corrola-vermelho-2016-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-vermelho-2016-1.webp',
                'path'       => 'storage/vehicle_photos/corrola-vermelho-2016-1.webp',
            ],
            [
                'photo_name' => 'corrola-vermelho-2016-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-vermelho-2016-2.webp',
                'path'       => 'storage/vehicle_photos/corrola-vermelho-2016-2.webp',
            ],
            [
                'photo_name' => 'corrola-vermelho-2016-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-vermelho-2016-3.webp',
                'path'       => 'storage/vehicle_photos/corrola-vermelho-2016-3.webp',
            ],
            [
                'photo_name' => 'corrola-vermelho-2016-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-vermelho-2016-4.webp',
                'path'       => 'storage/vehicle_photos/corrola-vermelho-2016-4.webp',
            ],
            [
                'photo_name' => 'corrola-vermelho-2016-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/corrola-vermelho-2016-5.webp',
                'path'       => 'storage/vehicle_photos/corrola-vermelho-2016-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-05-01',
            'purchase_price'   => 13000.00,
            'sale_price'       => 15000.00,
            'vehicle_model_id' => 35,
            'year_one'         => 2020,
            'year_two'         => 2021,
            'km'               => 17000,
            'color'            => 'Branca',
            'plate'            => 'AAA-0009',
            'renavan'          => '000000009',
            'chassi'           => '000000009',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'crosser-branca-2020-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-branca-2020-1.webp',
                'path'       => 'storage/vehicle_photos/crosser-branca-2020-1.webp',
            ],
            [
                'photo_name' => 'crosser-branca-2020-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-branca-2020-2.webp',
                'path'       => 'storage/vehicle_photos/crosser-branca-2020-2.webp',
            ],
            [
                'photo_name' => 'crosser-branca-2020-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-branca-2020-3.webp',
                'path'       => 'storage/vehicle_photos/crosser-branca-2020-3.webp',
            ],
            [
                'photo_name' => 'crosser-branca-2020-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-branca-2020-4.webp',
                'path'       => 'storage/vehicle_photos/crosser-branca-2020-4.webp',
            ],
            [
                'photo_name' => 'crosser-branca-2020-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-branca-2020-5.webp',
                'path'       => 'storage/vehicle_photos/crosser-branca-2020-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2023-12-25',
            'purchase_price'   => 12000.00,
            'sale_price'       => 15500.00,
            'vehicle_model_id' => 35,
            'year_one'         => 2020,
            'year_two'         => 2020,
            'km'               => 20120,
            'color'            => 'Preto',
            'plate'            => 'AAA-0025',
            'renavan'          => '000000025',
            'chassi'           => '000000025',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'crosser-preta-2020-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-preta-2020-1.webp',
                'path'       => 'storage/vehicle_photos/crosser-preta-2020-1.webp',
            ],
            [
                'photo_name' => 'crosser-preta-2020-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-preta-2020-2.webp',
                'path'       => 'storage/vehicle_photos/crosser-preta-2020-2.webp',
            ],
            [
                'photo_name' => 'crosser-preta-2020-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-preta-2020-3.webp',
                'path'       => 'storage/vehicle_photos/crosser-preta-2020-3.webp',
            ],
            [
                'photo_name' => 'crosser-preta-2020-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-preta-2020-4.webp',
                'path'       => 'storage/vehicle_photos/crosser-preta-2020-4.webp',
            ],
            [
                'photo_name' => 'crosser-preta-2020-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/crosser-preta-2020-5.webp',
                'path'       => 'storage/vehicle_photos/crosser-preta-2020-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-01-02',
            'purchase_price'   => 32000.00,
            'sale_price'       => 40000.00,
            'vehicle_model_id' => 13,
            'year_one'         => 2017,
            'year_two'         => 2018,
            'km'               => 20120,
            'color'            => 'Preto',
            'plate'            => 'AAA-0010',
            'renavan'          => '000000010',
            'chassi'           => '000000010',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'hb20-preto-2017-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-preto-2017-1.webp',
                'path'       => 'storage/vehicle_photos/hb20-preto-2017-1.webp',
            ],
            [
                'photo_name' => 'hb20-preto-2017-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-preto-2017-2.webp',
                'path'       => 'storage/vehicle_photos/hb20-preto-2017-2.webp',
            ],
            [
                'photo_name' => 'hb20-preto-2017-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-preto-2017-3.webp',
                'path'       => 'storage/vehicle_photos/hb20-preto-2017-3.webp',
            ],
            [
                'photo_name' => 'hb20-preto-2017-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-preto-2017-4.webp',
                'path'       => 'storage/vehicle_photos/hb20-preto-2017-4.webp',
            ],
            [
                'photo_name' => 'hb20-preto-2017-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-preto-2017-5.webp',
                'path'       => 'storage/vehicle_photos/hb20-preto-2017-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-01-04',
            'purchase_price'   => 28000.00,
            'sale_price'       => 35000.00,
            'vehicle_model_id' => 13,
            'year_one'         => 2015,
            'year_two'         => 2015,
            'km'               => 20120,
            'color'            => 'Vermelho',
            'plate'            => 'AAA-0011',
            'renavan'          => '000000011',
            'chassi'           => '000000011',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'hb20-vermelho-2015-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-vermelho-2015-1.webp',
                'path'       => 'storage/vehicle_photos/hb20-vermelho-2015-1.webp',
            ],
            [
                'photo_name' => 'hb20-vermelho-2015-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-vermelho-2015-2.webp',
                'path'       => 'storage/vehicle_photos/hb20-vermelho-2015-2.webp',
            ],
            [
                'photo_name' => 'hb20-vermelho-2015-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-vermelho-2015-3.webp',
                'path'       => 'storage/vehicle_photos/hb20-vermelho-2015-3.webp',
            ],
            [
                'photo_name' => 'hb20-vermelho-2015-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-vermelho-2015-4.webp',
                'path'       => 'storage/vehicle_photos/hb20-vermelho-2015-4.webp',
            ],
            [
                'photo_name' => 'hb20-vermelho-2015-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hb20-vermelho-2015-5.webp',
                'path'       => 'storage/vehicle_photos/hb20-vermelho-2015-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-02-04',
            'purchase_price'   => 120000.00,
            'sale_price'       => 153000.00,
            'vehicle_model_id' => 27,
            'year_one'         => 2017,
            'year_two'         => 2017,
            'km'               => 42000,
            'color'            => 'Preta',
            'plate'            => 'AAA-0012',
            'renavan'          => '000000012',
            'chassi'           => '000000012',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'hilux-preta-2017-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-preta-2017-1.webp',
                'path'       => 'storage/vehicle_photos/hilux-preta-2017-1.webp',
            ],
            [
                'photo_name' => 'hilux-preta-2017-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-preta-2017-2.webp',
                'path'       => 'storage/vehicle_photos/hilux-preta-2017-2.webp',
            ],
            [
                'photo_name' => 'hilux-preta-2017-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-preta-2017-3.webp',
                'path'       => 'storage/vehicle_photos/hilux-preta-2017-3.webp',
            ],
            [
                'photo_name' => 'hilux-preta-2017-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-preta-2017-4.webp',
                'path'       => 'storage/vehicle_photos/hilux-preta-2017-4.webp',
            ],
            [
                'photo_name' => 'hilux-preta-2017-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-preta-2017-5.webp',
                'path'       => 'storage/vehicle_photos/hilux-preta-2017-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-05-30',
            'purchase_price'   => 160000.00,
            'sale_price'       => 180000.00,
            'vehicle_model_id' => 27,
            'year_one'         => 2022,
            'year_two'         => 2022,
            'km'               => 12000,
            'color'            => 'Cereja',
            'plate'            => 'AAA-0013',
            'renavan'          => '000000013',
            'chassi'           => '000000013',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'hilux-cereja-2022-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-cereja-2022-1.webp',
                'path'       => 'storage/vehicle_photos/hilux-cereja-2022-1.webp',
            ],
            [
                'photo_name' => 'hilux-cereja-2022-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-cereja-2022-2.webp',
                'path'       => 'storage/vehicle_photos/hilux-cereja-2022-2.webp',
            ],
            [
                'photo_name' => 'hilux-cereja-2022-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-cereja-2022-3.webp',
                'path'       => 'storage/vehicle_photos/hilux-cereja-2022-3.webp',
            ],
            [
                'photo_name' => 'hilux-cereja-2022-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-cereja-2022-4.webp',
                'path'       => 'storage/vehicle_photos/hilux-cereja-2022-4.webp',
            ],
            [
                'photo_name' => 'hilux-cereja-2022-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-cereja-2022-5.webp',
                'path'       => 'storage/vehicle_photos/hilux-cereja-2022-5.webp',
            ],
            [
                'photo_name' => 'hilux-cereja-2022-6.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/hilux-cereja-2022-6.webp',
                'path'       => 'storage/vehicle_photos/hilux-cereja-2022-6.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-04-01',
            'purchase_price'   => 30000.00,
            'sale_price'       => 37000.00,
            'vehicle_model_id' => 23,
            'year_one'         => 2019,
            'year_two'         => 2019,
            'km'               => 14000,
            'color'            => 'Branco',
            'plate'            => 'AAA-0014',
            'renavan'          => '000000014',
            'chassi'           => '000000014',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'kwid-branco-2019-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-branco-2019-1.webp',
                'path'       => 'storage/vehicle_photos/kwid-branco-2019-1.webp',
            ],
            [
                'photo_name' => 'kwid-branco-2019-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-branco-2019-2.webp',
                'path'       => 'storage/vehicle_photos/kwid-branco-2019-2.webp',
            ],
            [
                'photo_name' => 'kwid-branco-2019-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-branco-2019-3.webp',
                'path'       => 'storage/vehicle_photos/kwid-branco-2019-3.webp',
            ],
            [
                'photo_name' => 'kwid-branco-2019-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-branco-2019-4.webp',
                'path'       => 'storage/vehicle_photos/kwid-branco-2019-4.webp',
            ],
            [
                'photo_name' => 'kwid-branco-2019-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-branco-2019-5.webp',
                'path'       => 'storage/vehicle_photos/kwid-branco-2019-5.webp',
            ],
            [
                'photo_name' => 'kwid-branco-2019-6.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-branco-2019-6.webp',
                'path'       => 'storage/vehicle_photos/kwid-branco-2019-6.webp',
            ],
            [
                'photo_name' => 'kwid-branco-2019-7.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-branco-2019-7.webp',
                'path'       => 'storage/vehicle_photos/kwid-branco-2019-7.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-05-08',
            'purchase_price'   => 25000.00,
            'sale_price'       => 33000.00,
            'vehicle_model_id' => 23,
            'year_one'         => 2018,
            'year_two'         => 2018,
            'km'               => 21000,
            'color'            => 'Vermelho',
            'plate'            => 'AAA-0015',
            'renavan'          => '000000015',
            'chassi'           => '000000015',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'kwid-vermelho-2018-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-vermelho-2018-1.webp',
                'path'       => 'storage/vehicle_photos/kwid-vermelho-2018-1.webp',
            ],
            [
                'photo_name' => 'kwid-vermelho-2018-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-vermelho-2018-2.webp',
                'path'       => 'storage/vehicle_photos/kwid-vermelho-2018-2.webp',
            ],
            [
                'photo_name' => 'kwid-vermelho-2018-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-vermelho-2018-3.webp',
                'path'       => 'storage/vehicle_photos/kwid-vermelho-2018-3.webp',
            ],
            [
                'photo_name' => 'kwid-vermelho-2018-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-vermelho-2018-4.webp',
                'path'       => 'storage/vehicle_photos/kwid-vermelho-2018-4.webp',
            ],
            [
                'photo_name' => 'kwid-vermelho-2018-5.web',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/kwid-vermelho-2018-5.webp',
                'path'       => 'storage/vehicle_photos/kwid-vermelho-2018-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-02-04',
            'purchase_price'   => 13000.00,
            'sale_price'       => 20000.00,
            'vehicle_model_id' => 36,
            'year_one'         => 2020,
            'year_two'         => 2020,
            'km'               => 25000,
            'color'            => 'Azul',
            'plate'            => 'AAA-0016',
            'renavan'          => '000000016',
            'chassi'           => '000000016',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'lander-azul-2020-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/lander-azul-2020-1.webp',
                'path'       => 'storage/vehicle_photos/lander-azul-2020-1.webp',
            ],
            [
                'photo_name' => 'lander-azul-2020-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/lander-azul-2020-2.webp',
                'path'       => 'storage/vehicle_photos/lander-azul-2020-2.webp',
            ],
            [
                'photo_name' => 'lander-azul-2020-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/lander-azul-2020-3.webp',
                'path'       => 'storage/vehicle_photos/lander-azul-2020-3.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-01-03',
            'purchase_price'   => 120000.00,
            'sale_price'       => 165000.00,
            'vehicle_model_id' => 12,
            'year_one'         => 2018,
            'year_two'         => 2018,
            'km'               => 36000,
            'color'            => 'Branco',
            'plate'            => 'AAA-0017',
            'renavan'          => '000000017',
            'chassi'           => '000000017',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 's10-branco-2018-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-branco-2018-1.webp',
                'path'       => 'storage/vehicle_photos/s10-branco-2018-1.webp',
            ],
            [
                'photo_name' => 's10-branco-2018-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-branco-2018-2.webp',
                'path'       => 'storage/vehicle_photos/s10-branco-2018-2.webp',
            ],
            [
                'photo_name' => 's10-branco-2018-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-branco-2018-3.webp',
                'path'       => 'storage/vehicle_photos/s10-branco-2018-3.webp',
            ],
            [
                'photo_name' => 's10-branco-2018-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-branco-2018-4.webp',
                'path'       => 'storage/vehicle_photos/s10-branco-2018-4.webp',
            ],
            [
                'photo_name' => 's10-branco-2018-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-branco-2018-5.webp',
                'path'       => 'storage/vehicle_photos/s10-branco-2018-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-02-01',
            'purchase_price'   => 100000.00,
            'sale_price'       => 130000.00,
            'vehicle_model_id' => 12,
            'year_one'         => 2016,
            'year_two'         => 2016,
            'km'               => 26000,
            'color'            => 'Vermelha',
            'plate'            => 'AAA-0018',
            'renavan'          => '000000018',
            'chassi'           => '000000018',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 's10-vermelha-2016-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-vermelha-2016-1.webp',
                'path'       => 'storage/vehicle_photos/s10-vermelha-2016-1.webp',
            ],
            [
                'photo_name' => 's10-vermelha-2016-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-vermelha-2016-2.webp',
                'path'       => 'storage/vehicle_photos/s10-vermelha-2016-2.webp',
            ],
            [
                'photo_name' => 's10-vermelha-2016-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-vermelha-2016-3.webp',
                'path'       => 'storage/vehicle_photos/s10-vermelha-2016-3.webp',
            ],
            [
                'photo_name' => 's10-vermelha-2016-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-vermelha-2016-4.webp',
                'path'       => 'storage/vehicle_photos/s10-vermelha-2016-4.webp',
            ],
            [
                'photo_name' => 's10-vermelha-2016-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-vermelha-2016-5.webp',
                'path'       => 'storage/vehicle_photos/s10-vermelha-2016-5.webp',
            ],
            [
                'photo_name' => 's10-vermelha-2016-6.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/s10-vermelha-2016-6.webp',
                'path'       => 'storage/vehicle_photos/s10-vermelha-2016-6.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2023-11-12',
            'purchase_price'   => 8000.00,
            'sale_price'       => 11000.00,
            'vehicle_model_id' => 34,
            'year_one'         => 2012,
            'year_two'         => 2012,
            'km'               => 62000,
            'color'            => 'Azul',
            'plate'            => 'AAA-0019',
            'renavan'          => '000000019',
            'chassi'           => '000000019',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'titan-azul-2012-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-azul-2012-1.webp',
                'path'       => 'storage/vehicle_photos/titan-azul-2012-1.webp',
            ],
            [
                'photo_name' => 'titan-azul-2012-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-azul-2012-2.webp',
                'path'       => 'storage/vehicle_photos/titan-azul-2012-2.webp',
            ],
            [
                'photo_name' => 'titan-azul-2012-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-azul-2012-3.webp',
                'path'       => 'storage/vehicle_photos/titan-azul-2012-3.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2023-10-01',
            'purchase_price'   => 8500.00,
            'sale_price'       => 11000.00,
            'vehicle_model_id' => 34,
            'year_one'         => 2012,
            'year_two'         => 2012,
            'km'               => 62000,
            'color'            => 'Vermelha',
            'plate'            => 'AAA-0020',
            'renavan'          => '000000020',
            'chassi'           => '000000020',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'titan-vermelha-2012-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-vermelha-2012-1.webp',
                'path'       => 'storage/vehicle_photos/titan-vermelha-2012-1.webp',
            ],
            [
                'photo_name' => 'titan-vermelha-2012-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-vermelha-2012-2.webp',
                'path'       => 'storage/vehicle_photos/titan-vermelha-2012-2.webp',
            ],
            [
                'photo_name' => 'titan-vermelha-2012-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-vermelha-2012-3.webp',
                'path'       => 'storage/vehicle_photos/titan-vermelha-2012-3.webp',
            ],
            [
                'photo_name' => 'titan-vermelha-2012-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-vermelha-2012-4.webp',
                'path'       => 'storage/vehicle_photos/titan-vermelha-2012-4.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-02-03',
            'purchase_price'   => 10500.00,
            'sale_price'       => 13000.00,
            'vehicle_model_id' => 34,
            'year_one'         => 2015,
            'year_two'         => 2016,
            'km'               => 25000,
            'color'            => 'Vermelha',
            'plate'            => 'AAA-0021',
            'renavan'          => '000000021',
            'chassi'           => '000000021',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'titan-vermelha-2015-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-vermelha-2015-1.webp',
                'path'       => 'storage/vehicle_photos/titan-vermelha-2015-1.webp',
            ],
            [
                'photo_name' => 'titan-vermelha-2015-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-vermelha-2015-2.webp',
                'path'       => 'storage/vehicle_photos/titan-vermelha-2015-2.webp',
            ],
            [
                'photo_name' => 'titan-vermelha-2015-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-vermelha-2015-3.webp',
                'path'       => 'storage/vehicle_photos/titan-vermelha-2015-3.webp',
            ],
            [
                'photo_name' => 'titan-vermelha-2015-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-vermelha-2015-4.webp',
                'path'       => 'storage/vehicle_photos/titan-vermelha-2015-4.webp',
            ],
            [
                'photo_name' => 'titan-vermelha-2015-5.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/titan-vermelha-2015-5.webp',
                'path'       => 'storage/vehicle_photos/titan-vermelha-2015-5.webp',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-02-03',
            'purchase_price'   => 15000.00,
            'sale_price'       => 19000.00,
            'vehicle_model_id' => 38,
            'year_one'         => 2020,
            'year_two'         => 2021,
            'km'               => 25000,
            'color'            => 'Prata',
            'plate'            => 'AAA-0022',
            'renavan'          => '000000022',
            'chassi'           => '000000022',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'twister-prata-2020-1.jpg',
                'format'     => 'jpg',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/twister-prata-2020-1.jpg',
                'path'       => 'storage/vehicle_photos/twister-prata-2020-1.jpg',
            ],
            [
                'photo_name' => 'twister-prata-2020-2.jpg',
                'format'     => 'jpg',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/twister-prata-2020-2.jpg',
                'path'       => 'storage/vehicle_photos/twister-prata-2020-2.jpg',
            ],
            [
                'photo_name' => 'twister-prata-2020-3.jpg',
                'format'     => 'jpg',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/twister-prata-2020-3.jpg',
                'path'       => 'storage/vehicle_photos/twister-prata-2020-3.jpg',
            ],
            [
                'photo_name' => 'twister-prata-2020-4.jpg',
                'format'     => 'jpg',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/twister-prata-2020-4.jpg',
                'path'       => 'storage/vehicle_photos/twister-prata-2020-4.jpg',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-03-03',
            'purchase_price'   => 15200.00,
            'sale_price'       => 19000.00,
            'vehicle_model_id' => 38,
            'year_one'         => 2020,
            'year_two'         => 2021,
            'km'               => 25000,
            'color'            => 'Vermelha',
            'plate'            => 'AAA-0023',
            'renavan'          => '000000023',
            'chassi'           => '000000023',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'twister-vermelha-2020-1.jpg',
                'format'     => 'jpg',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/twister-vermelha-2020-1.jpg',
                'path'       => 'storage/vehicle_photos/twister-vermelha-2020-1.jpg',
            ],
            [
                'photo_name' => 'twister-vermelha-2020-2.jpg',
                'format'     => 'jpg',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/twister-vermelha-2020-2.jpg',
                'path'       => 'storage/vehicle_photos/twister-vermelha-2020-2.jpg',
            ],
            [
                'photo_name' => 'twister-vermelha-2020-3.jpg',
                'format'     => 'jpg',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/twister-vermelha-2020-3.jpg',
                'path'       => 'storage/vehicle_photos/twister-vermelha-2020-3.jpg',
            ],
            [
                'photo_name' => 'twister-vermelha-2020-4.jpg',
                'format'     => 'jpg',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/twister-vermelha-2020-4.jpg',
                'path'       => 'storage/vehicle_photos/twister-vermelha-2020-4.jpg',
            ],
        ]);

        Vehicle::create([
            'purchase_date'    => '2024-03-01',
            'purchase_price'   => 15500.00,
            'sale_price'       => 19000.00,
            'vehicle_model_id' => 39,
            'year_one'         => 2020,
            'year_two'         => 2020,
            'km'               => 25000,
            'color'            => 'Preta',
            'plate'            => 'AAA-0024',
            'renavan'          => '000000024',
            'chassi'           => '000000024',
            'description'      => 'Veículo em ótimo estado de conservação.',
        ])->photos()->createMany([
            [
                'photo_name' => 'xre-preta-2020-1.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/xre-preta-2020-1.webp',
                'path'       => 'storage/vehicle_photos/xre-preta-2020-1.webp',
            ],
            [
                'photo_name' => 'xre-preta-2020-2.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/xre-preta-2020-2.webp',
                'path'       => 'storage/vehicle_photos/xre-preta-2020-2.webp',
            ],
            [
                'photo_name' => 'xre-preta-2020-3.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/xre-preta-2020-3.webp',
                'path'       => 'storage/vehicle_photos/xre-preta-2020-3.webp',
            ],
            [
                'photo_name' => 'xre-preta-2020-4.webp',
                'format'     => 'webp',
                'full_path'  => 'C:\Users\Duhasky\Documents\Projetos\MotorMarket\storage\app/vehicle_photos/xre-preta-2020-4.webp',
                'path'       => 'storage/vehicle_photos/xre-preta-2020-4.webp',
            ],
        ]);
    }
}
