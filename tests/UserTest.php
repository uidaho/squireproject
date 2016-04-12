<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * Test user authentication and what that user should view
     *
     * @return void
     */
    public function testUser()
    {
        $user = factory(App\User::class)->make();

        // Visit without being logged in, should stay
        $this->visit('/')
            ->seePageIs('/');

        // Log In
        $this->actingAs($user);

        // Visit as logged in, should be redirected
        $this->call('GET', '/')
            ->isRedirect('/projectfinder');

        // Should find username in page (top right)
        $this->visit('/projectfinder')
            ->see($user->username);
    }
}
