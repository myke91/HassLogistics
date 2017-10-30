<?php

use Illuminate\Database\Seeder;
use App\TarrifParams;

class TarrifParamsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        TarrifParams::create([
            'tarrif_param_name' => 'BULK GRAINS',
            'tarrif_param_charge_type' => 'QUANTITY',
            'tarrif_param_remarks' => 'Applicable to imports and exports. '
            . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
            'tarrif_type_id' => 1
        ]);
    }

}
