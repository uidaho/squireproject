<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * Test the login page, both good login and a bad login
     *
     * @return void
     */
    public function testLogin()
    {
        // Test bad login
        $this->visit('/login')
            ->type('test_user', 'username')
            ->type('test_secret', 'password')
            ->press('submit')
            ->seePageIs('/login');

        // Test good login
        $password = "testing_password";
        $user = factory(App\User::class)->create([
            'username' => 'test_user',
            'password' => bcrypt($password)
        ]);

        $this->visit('/login')
            ->type($user->username, 'username')
            ->type($password, 'password')
            ->press('submit')
            ->see($user->username)
            ->seePageIs('/projectfinder');

        // Delete user for testing login
        App\User::destroy($user->id);
    }
}
