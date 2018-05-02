<?php

use Illuminate\Database\Seeder;
use App\Coursestudentstatus;

class CoursestudentstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coursestudentstatus::create([
            'coursestudentstatus_id'     => 'CSSTUDSTAT001',
            'description'    => 'ENROLLED'
        ]);

        Coursestudentstatus::create([
            'coursestudentstatus_id'     => 'CSSTUDSTAT002',
            'description'    => 'CONTINUING'
        ]);

        Coursestudentstatus::create([
            'coursestudentstatus_id'     => 'CSSTUDSTAT003',
            'description'    => 'DROPPED'
        ]);
    }
}
