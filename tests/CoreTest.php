<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CoreTest extends TestCase
{
    /**
     * Test the base website
     *
     * @return void
     */
    public function testCore()
    {
        $this->visit('/')
             ->see('sQuire');
    }
}
