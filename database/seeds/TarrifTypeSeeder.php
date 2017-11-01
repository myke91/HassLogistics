<?php

use Illuminate\Database\Seeder;
use App\TarrifType;

class TarrifTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        TarrifType::insert([
            [
                'tarrif_type_name' => 'PORT DUES ON CARGO',
                'tarrif_type_code'=>'A',
                'tarrif_id' => 1,
            ],
            [
                'tarrif_type_name' => 'PIPELINE DUES',
                'tarrif_type_code'=>'B',
                'tarrif_id' => 1,
            ],
            [
                'tarrif_type_name' => 'LIGHT DUES',
                'tarrif_type_code'=>'B',
                'tarrif_id' => 1,
            ],
            [
                'tarrif_type_name' => 'GENERAL PORT CLEANING DUES',
                'tarrif_type_code'=>'C',
                'tarrif_id' => 1,
            ],
            [
                'tarrif_type_name' => 'OILTERMINAL LOADING ARM DUES',
                'tarrif_type_code'=>'D',
                'tarrif_id' => 1,
            ],
            [
                'tarrif_type_name' => 'ISPS CODE IMPLEMENTATION DUES',
                'tarrif_type_code'=>'E',
                'tarrif_id' => 1
            ],
            [
                'tarrif_type_name' => 'VESSEL HANDLING',
                'tarrif_type_code'=>'A',
                'tarrif_id' => 2
            ],
            [
                'tarrif_type_name' => 'DETENTION OF PILOT AND CANCELLATION OF MOVEMENT',
                'tarrif_type_code'=>'B',
                'tarrif_id' => 2,
            ],
            [
                'tarrif_type_name' => 'MOVEMENT OF VESSELS TO/FROM TEMA DRY DOCK',
                'tarrif_type_code'=>'C',
                'tarrif_id' => 2
            ],
            [
                'tarrif_type_name' => 'SUPPLY OF FRESH WATER AND UNDER WATER SERVICES',
                'tarrif_type_code'=>'D',
                'tarrif_id' => 2
            ]
        ]);
    }

}
