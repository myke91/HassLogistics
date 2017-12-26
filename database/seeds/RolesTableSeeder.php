<?php

use Illuminate\Database\Seeder;
use HASSLOGISTICS\Role;

class RolesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Role::insert([
                ['name' => 'Admin'],
                ['name' => 'Clerk'],
                ['name' => 'Manager'],
                ['name' => 'Cashier'],
                ['name' => 'Front Desk']
        ]);
    }

}
