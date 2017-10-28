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
        TarrifType::create([
            'tarrif_type_name' => 'PORT DUES ON CARGO',
            'tarrif_id' => 1
        ]);
    }

}
