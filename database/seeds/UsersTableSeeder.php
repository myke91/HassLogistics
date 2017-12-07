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

        User::insert(
                [
                    [
                    'fullname' => 'Michael Dugah',
                    'username' => 'myke.dugah',
                    'role_id' => 1,
                    'email' => 'myke.dugah@gmail.com',
                    'password' => bcrypt('admin'),
                    'remember_token' => str_random(10),
                    ],
            [
                'fullname' => 'Fred Ahanogbe',
                'username' => 'freddie',
                'role_id' => 1,
                'email' => 'fred.ahanogbe@gmail.com',
                'password' => bcrypt('123456'),
                'remember_token' => str_random(10),
                ]
        ]);
    }

}
