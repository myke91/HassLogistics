<?php

use Illuminate\Database\Seeder;

class VesselOperatorSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \HASSLOGISTICS\VesselOperator::create(
                ['operator_name' => 'MAERSK']
        );
    }

}
