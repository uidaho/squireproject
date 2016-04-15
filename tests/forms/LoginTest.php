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
        $this->visit('/login')
            ->submitForm('submit',[
                'username' => 'test_user',
                'password' => 'test_secret',
            ])->seePageIs('/login');

        // Test good login
        $password = "test_secret";
        $user = factory(App\User::class)->create([
            'username' => 'test_user',
            'password' => bcrypt($password)
        ]);

        $this->visit('/login')
            ->submitForm('submit',[
                'username' => 'test_user',
                'password' => 'test_secret',
            ])->seePageIs('/projectfinder');

        // Delete user for testing login
        App\User::destroy($user->id);
    }
}
