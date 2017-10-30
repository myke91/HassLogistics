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
        TarrifCharge::create([
            'billable' => 'PER TONNE',
            'cost' => 50000.28,
            'tarrif_param_id' => 1
        ]);
    }

}
