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
            ],
            [
                'billable' => 'PER TONNE',
                'cost' => 2.00,
                'tarrif_param_id' => 2
            ],[
                'billable' => 'PER TONNE',
                'cost' => 1.00,
                'tarrif_param_id' => 3
            ],[
                'billable' => 'PER TONNE',
                'cost' => 1.00,
                'tarrif_param_id' => 4
            ],
            [
                'billable' => 'CONTAINER UP TO 20" IN LENGTH',
                'cost' => 45.00,
                'tarrif_param_id' => 10
            ],[
                'billable' => 'CONTAINER ABOVE 20" BUT NOT MORE THAN 40" IN LENGTH',
                'cost' => 83.50,
                'tarrif_param_id' => 10
            ],[
                'billable' => 'CONTAINER ABOVE 40" IN LENGTH',
                'cost' => 96.50,
                'tarrif_param_id' => 10
            ]
        ]);
    }

}
