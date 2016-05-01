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
    public function testShortUsername()
    {
        // Submit short username
        $this->tryRegister('short', 'ok@email.com', 'test_secret', 'test_secret')
            ->seePageIs('/register');
    }

    public function testBadEmail()
    {
        // Submit malformed email
        $this->tryRegister('test_user', 'bademail', 'test_secret', 'test_secret')
            ->seePageIs('/register');
    }

    public function testMismatchedPasswords()
    {
        // Submit mismatched passwords
        $this->tryRegister('test_user', 'ok@email.com', 'mismatched', 'test_secret')
            ->seePageIs('/register');

        // Submit mismatched passwords
        $this->tryRegister('test_user', 'ok@email.com', 'test_secret', 'mismatched')
            ->seePageIs('/register');
    }

    public function testShortPassword()
    {
        // Submit short password
        $this->tryRegister('test_user', 'ok@email.com', 'short', 'short')
            ->seePageIs('/register');
    }

    public function testGoodRegistration()
    {
        // Submit a good form
        $this->tryRegister('test_user', 'ok@email.com', 'test_secret', 'test_secret')
            ->seeInDatabase('users', ['username' => 'test_user'])
            ->seePageIs('/project/create');

        // Delete user created from success
        DB::table('users')
            ->where('username', '=', 'test_user')
            ->delete();
    }

    private function tryRegister($username, $email, $pass, $passConf)
    {
        return $this->visit('/register')
            ->submitForm('submit', [
                'username' => $username,
                'email' => $email,
                'password' => $pass,
                'password_confirmation' => $passConf
            ]);
    }
}
