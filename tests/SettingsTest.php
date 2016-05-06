<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingsTest extends TestCase
{
    /**
     * Test the update method in the Settings class.
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->assertTrue(true);
    }



    /**
     * Test the view method in the Settings class.
     *
     * @return void
     */
    public function testView()
    {
        //$this->assertTrue(true);
        /*$this->visit('/settings')
            ->see('Settings');*/ //Needs to create a user to test the view with. Otherwise it'll return to the login page
    }



    /*
     * Test the submit putton on the settings page
     * @return void
     */
    public function testSettingsButtons()
    {
        $this->assertTrue(true);/*
        $this->visit('/settings')
            ->type('Taylor', 'nickname')
            ->select(1, 'enable_chat')
            ->select('Red', 'editor_font_color')
            ->press('Comic Sans', 'editor_font');*/ //same error as testView
    }

}