<?php

use Illuminate\Database\Seeder;
use App\Tarrif;

class TarrifSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Tarrif::insert([
                [
                'tarrif_name' => 'PORT DUES'
            ], [
                'tarrif_name' => 'VESSEL HANDELING CHARGES'
            ]
        ]);
    }

}
