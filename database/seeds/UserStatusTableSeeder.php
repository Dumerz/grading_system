<?php

use Illuminate\Database\Seeder;
use App\UserStatus;

class UserstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Userstatus::create([
            'userstatus_id'     => 'USRSTAT001',
            'description'    => 'NEW'
        ]);

        Userstatus::create([
            'userstatus_id'     => 'USRSTAT002',
            'description'    => 'ACTIVE'
        ]);

        Userstatus::create([
            'userstatus_id'     => 'USRSTAT003',
            'description'    => 'DEACTIVE'
        ]);
    }
}
