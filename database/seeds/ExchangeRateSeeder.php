<?php

use HASSLOGISTICS\ExchangeRate;
use Illuminate\Database\Seeder;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExchangeRate::insert([
            [
                'currency' => 'USD',
                'selling_price' => 4.5,
                'buying_price' => 4.3,
            ], [
                'currency' => 'GHS',
                'selling_price' => 1,
                'buying_price' => 1,
            ],
        ]
        );
    }
}
