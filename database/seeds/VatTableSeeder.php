<?php

use Illuminate\Database\Seeder;
use App\Vat;

class VatTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Vat::create(
                [
                    'value' => 17.5
        ]);
    }

}
