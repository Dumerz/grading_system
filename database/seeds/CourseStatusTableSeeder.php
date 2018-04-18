<?php

use Illuminate\Database\Seeder;
use App\Coursestatus;

class CourseStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coursestatus::create([
            'coursestatus_id'     => 'CSSTAT001',
            'description'    => 'UNPUBLISHED'
        ]);

        Coursestatus::create([
            'coursestatus_id'     => 'CSSTAT002',
            'description'    => 'PUBLISHED'
        ]);

        Coursestatus::create([
            'coursestatus_id'     => 'CSSTAT003',
            'description'    => 'ARCHIVED'
        ]);
    }
}
