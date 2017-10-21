<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'role_id'=>1,
            'active'=>1,
            'name'=>'Fred Ahanogbe',
            'username'=>'fred',
            'email'=>'fred.ahanogbe@gmail.com',
            'password'=>bcrypt('fred'),
            'remember_token'=>str_random(10),

        ]);

    }
}
