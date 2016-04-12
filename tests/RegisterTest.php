<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class RegisterTest extends TestCase
{
    /**
     * Tests the registration form
     *
     * @return void
     */
    public function testRegistration()
    {
        // Submit short username
        $this->tryRegister('short', 'ok@email.com', 'test_secret', 'test_secret')
            ->seePageIs('/register');

        // Submit malformed email
        $this->tryRegister('test_user', 'bademail', 'test_secret', 'test_secret')
            ->seePageIs('/register');

        // Submit mismatched passwords
        $this->tryRegister('test_user', 'ok@email.com', 'mismatched', 'test_secret')
            ->seePageIs('/register');

        // Submit mismatched passwords
        $this->tryRegister('test_user', 'ok@email.com', 'test_secret', 'mismatched')
            ->seePageIs('/register');

        // Submit short password
        $this->tryRegister('test_user', 'ok@email.com', 'short', 'short')
            ->seePageIs('/register');

        // Submit a good form
        $this->tryRegister('test_user', 'ok@email.com', 'test_secret', 'test_secret')
            ->seeInDatabase('users', ['username' => 'test_user'])
            ->seePageIs('/projectfinder');

        // Delete user created from success
        DB::table('users')
            ->where('username', '=', 'test_user')
            ->delete();
    }

    private function tryRegister($username, $email, $pass, $passConf)
    {
        return $this->visit('/register')
            ->type($username, 'username')
            ->type($email, 'email')
            ->type($pass, 'password')
            ->type($passConf, 'password_confirmation')
            ->press('submit');
    }
}
