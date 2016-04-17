<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditorTest extends TestCase
{
    /**
     * Test the editFile method in the Editor class.
     *
     * @return void
     */
    public function testEditFile()
    {
        // create user
        $user = factory(App\User::class)->make();
        // login
        $this->actingAs($user);
        // look for username to confirm login
        $this->visit('editor')
            ->see($user->username);
    }
    
    public function testListFiles() 
    {
        $this->assertTrue(true);
    }
    
    public function testIndex()
    {
        $this->assertTrue(true);
    }
    
    public function testCreate()
    {
        $this->assertTrue(true);
    }
    
    public function testCreateView()
    {
        $this->assertTrue(true);
    }
    
    public function testDelete()
    {
        $this->assertTrue(true);
    }
    
    public function testDeleteView()
    {
        $this->assertTrue(true);
    }
    
    public function testQuoteOfTheDay()
    {
        $this->assertTrue(true);
    }
}
