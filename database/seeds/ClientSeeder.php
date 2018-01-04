<?php

use HASSLOGISTICS\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create(
            [
                'client_name' => 'SG',
                'client_office_desc' => 'Roadside',
                'client_head_office' => 'BG',
                'client_number' => '02455353662',
                'client_email' => 'mike_dugah@yahoo.com',
                'client_currency' => 'GHS',
                'client_digital_address' => 'AK-344-22331',
            ]);
    }
}
