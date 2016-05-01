<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectFollowTest extends TestCase
{

    private $user1 = null;
    private $user2 = null;
    private $project = null;

    /**
     * Prepare for the test, creating a user and entry to work with during the test.
     *
     */
    protected function setUp() {
        parent::setUp();

        // Ensure that the entry was deleted in the case of a failed test.
        $this->beforeApplicationDestroyed(function() {
            $this->project->delete();
            $this->user1->delete();
            $this->user2->delete();
        });

        $this->user1 = factory(App\User::class)->create([
            'username' => 'Eric_Cartman',
            'email' => 'temp117@temp.com',
            'password' => 'password'
        ]);

        $this->user2 = factory(App\User::class)->create([
            'username' => 'Eric_Cartman2',
            'email' => 'temp1177@temp.com',
            'password' => 'password'
        ]);

        $this->project = \App\Project::create([
            'author' => $this->user1->username,
            'title' => 'Test Project',
            'description' => 'For testing',
            'body' => 'This is a simple test body'
        ]);
    }

    /**
     * Test the visibility of follow text and buttons for guests.
     *
     * @return void
     */
    public function testGuestPermissions()
    {
        //Test as guest
        $this->visit($this->project->getSlug())
            ->see('follow-login')
            ->see('Followers:');
    }

    /**
     * Test the visibility of follow text and buttons for the project creator.
     *
     * @return void
     */
    public function testCreatorPermissions()
    {
        //Test as project creator
        $this->actingAs($this->user1)
            ->visit($this->project->getSlug())
            ->dontSee('follow-add')
            ->see('Followers:');
    }

    /**
     * Test the visibility of follow text and buttons for users that arn't the creator of the project.
     *
     * @return void
     */
    public function testNonCreatorPermissions()
    {
        //Test as not project creator
        $this->actingAs($this->user2)
            ->visit($this->project->getSlug())
            ->see('follow-add')
            ->see('Followers:');
    }

    /**
     * Test following a project by checking for database storage and viewing injections
     */
    public function testFollow()
    {
        $this->actingAs($this->user2)
            ->visit($this->project->getSlug())
            ->press('follow-add')
            ->seePageIs($this->project->getSlug())
            ->seeInDatabase('project_followers', ['user_id' => $this->user2->id])
            ->see('You are now following this project.')
            ->see('follow-remove');

        //Remove follower
        $this->project->followers()->delete();
    }

    /**
     * Test un-following a project by checking database deletion and viewing injections
     */
    public function testUnFollow()
    {
        \App\ProjectFollower::create([
            'user_id' => $this->user2->id,
            'project_id' => $this->project->id,
        ]);

        $this->actingAs($this->user2)
            ->visit($this->project->getSlug())
            ->press('follow-remove')
            ->seePageIs($this->project->getSlug())
            ->dontSeeInDatabase('project_followers', ['user_id' => $this->user2->id])
            ->see('You are now not following this project.')
            ->see('follow-add');

        //Remove follower
        $this->project->followers()->delete();
    }
}
