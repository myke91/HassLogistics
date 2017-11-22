<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        User::create(
              
                [
                'name' => 'Michael Dugah',
                'username' => 'myke.dugah',
                'email' => 'myke.dugah@gmail.com',
                'password' => 'admin',
                'remember_token' => str_random(10),
            
        ]);
    }

}
