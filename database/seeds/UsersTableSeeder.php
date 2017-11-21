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

        User::insert([
                [
                'name' => 'Fred Ahanogbe',
                'username' => 'fred',
                'email' => 'fred.ahanogbe@gmail.com',
                'password' => '123456',
                'remember_token' => str_random(10),
            ],
                [
                'name' => 'Michael Dugah',
                'username' => 'myke.dugah',
                'email' => 'myke.dugah@gmail.com',
                'password' => 'admin',
                'remember_token' => str_random(10),
            ]
        ]);
    }

}
