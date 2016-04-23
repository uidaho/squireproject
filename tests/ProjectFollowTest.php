<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectFollowTest extends TestCase
{

    private $user = null;
    private $entry = null;

    /**
     * Prepare for the test, creating a user and entry to work with during the test.
     *
     */
    protected function setUp() {
        parent::setUp();

        // Ensure that the entry was deleted in the case of a failed test.
        $this->beforeApplicationDestroyed(function() {
            $this->entry->delete();
            $this->user->delete();
        });

        $this->user = factory(App\User::class)->create([
            'username' => 'Eric_Cartman',
            'email' => 'temp117@temp.com',
            'password' => 'password'
        ]);

        $this->entry = \App\Project::create([
            'author' => $this->user->username,
            'title' => 'Test Project',
            'description' => 'For testing',
            'body' => 'This is a simple test body'
        ]);
    }

    /**
     * Test the visibility of text and buttons.
     *
     * @return void
     */
    public function testUserPermissions()
    {
        $this->visit($this->entry->getSlug())
            ->see('follow-login')
            ->see('Followers:');

        $this->actingAs($this->user)
            ->visit($this->entry->getSlug())
            ->see('follow-add')
            ->see('Followers:');
    }

    /**
     * Test following a project by checking for database storage and viewing injections
     */
    public function testFollow()
    {
        $this->actingAs($this->user)
            ->visit($this->entry->getSlug())
            ->press('follow-add')
            ->seePageIs($this->entry->getSlug())
            ->seeInDatabase('project_followers', ['project_id' => $this->entry->id])
            ->see('You are now following this project.')
            ->see('follow-remove');

        //Remove follower
        $this->entry->followers()->delete();
    }

    /**
     * Test following a project already being followed by someone else
     */
    public function testNonFollowerView()
    {
        $this->actingAs($this->user)
            ->visit($this->entry->getSlug())
            ->press('follow-add');

        $this->user2 = factory(App\User::class)->create([
            'username' => 'Eric_Cartman2',
            'email' => 'temp1177@temp.com',
            'password' => 'password'
        ]);

        $this->actingAs($this->user2)
            ->visit($this->entry->getSlug())
            ->see('follow-add')
            ->see('Followers:');

        //Remove user2
        $this->user2->delete();

        //Remove follower
        $this->entry->followers()->delete();
    }

    /**
     * Test unfollowing a project by checking database deletion and viewing injections
     */
    public function testUnFollow()
    {
        $this->actingAs($this->user)
            ->visit($this->entry->getSlug())
            ->press('follow-add')
            ->press('follow-remove')
            ->seePageIs($this->entry->getSlug())
            ->dontSeeInDatabase('project_followers', ['project_id' => $this->entry->id])
            ->see('You are now not following this project.')
            ->see('follow-add');

        //Remove follower
        $this->entry->followers()->delete();
    }
}
