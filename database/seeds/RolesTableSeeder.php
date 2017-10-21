<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
         ['name'=>'Admin'] ,
         ['name'=>'Receptionist'],
            ['name'=>'Manager'],
            ['name'=>'CEO']
        ]);
    }
}
