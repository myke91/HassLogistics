<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TarrifSeeder::class);
        $this->call(TarrifTypeSeeder::class);
        $this->call(TarrifParamsSeeder::class);
        $this->call(TarrifChargeSeeder::class);
    }

}
