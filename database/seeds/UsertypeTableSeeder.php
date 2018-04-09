<?php

use Illuminate\Database\Seeder;
use App\Usertype;

class UsertypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usertype::create([
            'usertype_id'     => 'USRTYPE001',
            'description'    => 'RATEE'
        ]);

        Usertype::create([
            'usertype_id'     => 'USRTYPE002',
            'description'    => 'RATER'
        ]);

        Usertype::create([
            'usertype_id'     => 'USRTYPE003',
            'description'    => 'ADMINISTRATOR'
        ]);
    }
}
