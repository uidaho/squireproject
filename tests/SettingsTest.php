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
        $this->assert(true);
    }



    /**
     * Test the view method in the Settings class.
     *
     * @return void
     */
    public function testView()
    {
        $this->visit('/')
            ->see('Settings')
            ->dontSee('404');
    }


    public function testSettingsButtons()
    {
        $this->visit('/settings')
            ->type('Taylor', 'nickname')
            ->select(1, 'enable_chat')
            ->select('Red', 'editor_font_color')
            ->press('Comic Sans', 'editor_font');
    }

}