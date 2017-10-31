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
        TarrifParams::insert(
        [
            [
                'tarrif_param_name' => 'BULK GRAINS',
                'tarrif_param_charge_type' => 'QUANTITY',
                'tarrif_param_remarks' => 'Applicable to imports and exports. '
                . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
                'tarrif_type_id' => 1
            ], 
            [
                'tarrif_param_name' => 'BULK CLINKER',
                'tarrif_param_charge_type' => 'QUANTITY',
                'tarrif_param_remarks' => 'Applicable to imports and exports. '
                . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
                'tarrif_type_id' => 1
            ], 
            [
                'tarrif_param_name' => 'BULK BAUXITE',
                'tarrif_param_charge_type' => 'QUANTITY',
                'tarrif_param_remarks' => 'Applicable to imports and exports. '
                . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
                'tarrif_type_id' => 1
            ], 
            [
                'tarrif_param_name' => 'BULK MANGANESE',
                'tarrif_param_charge_type' => 'QUANTITY',
                'tarrif_param_remarks' => 'Applicable to imports and exports. '
                . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
                'tarrif_type_id' => 1
            ], 
            [
                'tarrif_param_name' => 'BULK GYPSUM',
                'tarrif_param_charge_type' => 'QUANTITY',
                'tarrif_param_remarks' => 'Applicable to imports and exports. '
                . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
                'tarrif_type_id' => 1
            ], 
            [
                'tarrif_param_name' => 'BULK LIMESTONE',
                'tarrif_param_charge_type' => 'QUANTITY',
                'tarrif_param_remarks' => 'Applicable to imports and exports. '
                . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
                'tarrif_type_id' => 1
            ], 
            [
                'tarrif_param_name' => 'BULK CEMENT',
                'tarrif_param_charge_type' => 'QUANTITY',
                'tarrif_param_remarks' => 'Applicable to imports and exports. '
                . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
                'tarrif_type_id' => 1
            ], 
            [
                'tarrif_param_name' => 'BULK FERTILIZERS [CHEMICAL AND ORGANIC]',
                'tarrif_param_charge_type' => 'QUANTITY',
                'tarrif_param_remarks' => 'Applicable to imports and exports. '
                . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
                'tarrif_type_id' => 1
            ], 
            [
                'tarrif_param_name' => 'DRY BULK CARGOES NOS',
                'tarrif_param_charge_type' => 'QUANTITY',
                'tarrif_param_remarks' => 'Applicable to imports and exports. '
                . 'Bagged grains, cement, and chemical fertilizers do not fall under these items.',
                'tarrif_type_id' => 1
            ]
        ]);
    }

}
