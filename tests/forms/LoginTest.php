<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{

    private $user = null;

    /**
     * Prepare for the test, creating a user and entry to work with during the test.
     *
     */
    protected function setUp() {
        parent::setUp();

        // Ensure that the entry was deleted in the case of a failed test.
        $this->beforeApplicationDestroyed(function() {
            $this->user->delete();
        });

        $this->user = factory(App\User::class)->create([
            'username' => 'test_user',
            'email' => 'test@test.com',
            'password' => bcrypt('test_secret')
        ]);
    }

    /**
     * Test the login page with invalid info
     *
     * @return void
     */
    public function testInvalidLogin()
    {
        $this->visit('/login')
            ->type('wrong_user', 'username')
            ->type('test_secret', 'password')
            ->press('submit')
            ->seePageIs('/login');
    }

    /**
     * Test the login page with valid info using username
     *
     * @return void
     */
    public function testValidUsernameLogin()
    {
        $this->visit('/login')
            ->seeInDatabase('users', ['username' => 'test_user'])
            ->type('test_user', 'username')
            ->type('test_secret', 'password')
            ->press('submit')
            ->seePageIs('/project/create');
    }
}
