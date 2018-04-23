<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    protected $user;
    protected $database = 'users';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDatabase()
    {
        $this->user = factory(\App\User::class,10)->create();
    }
}
