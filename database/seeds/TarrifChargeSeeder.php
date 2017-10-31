<?php

use Illuminate\Database\Seeder;
use App\TarrifCharge;

class TarrifChargeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        TarrifCharge::insert([
            [
                'billable' => 'PER TONNE',
                'cost' => 2.00,
                'tarrif_param_id' => 1
            ]
        ]);
    }

}
