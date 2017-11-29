<?php

use Illuminate\Database\Seeder;

class VesselOperatorSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \App\VesselOperator::create(
                ['operator_name' => 'MAERSK']
        );
    }

}
