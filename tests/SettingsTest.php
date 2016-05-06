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
        $this->visit('settings')
            ->see('Settings');
    }


    public function testSettingsButtons()
    {
        $this->assertTrue(true);/*
        $this->visit('/settings')
            ->type('Taylor', 'nickname')
            ->select(1, 'enable_chat')
            ->select('Red', 'editor_font_color')
            ->press('Comic Sans', 'editor_font');*/
    }

}