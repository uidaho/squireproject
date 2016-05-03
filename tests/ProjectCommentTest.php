<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectCommentTest extends TestCase
{

    private $user = null;
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
            $this->user->delete();
        });

        $this->user = factory(App\User::class)->create([
            'username' => 'Eric_Cartman',
            'email' => 'temp117@temp.com',
            'password' => 'password'
        ]);

        $this->project = \App\Project::create([
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
        $this->visit($this->project->getSlug())
            ->see('Warning')
            ->see('comment-login')
            ->dontSeeLink('Send');

        $this->actingAs($this->user)
            ->visit($this->project->getSlug())
            ->dontSee('Warning')
            ->see('submit-comment');
    }

    /**
     * Test submitting a comment and checking for database storage and view injection
     */
    public function testCreate()
    {
        $this->actingAs($this->user)
            ->visit($this->project->getSlug())
            ->type('Please, can we just go back and get the Toshiba Handibook?', 'comment_body')
            ->press('submit-comment')
            ->seePageIs($this->project->getSlug())
            ->seeInDatabase('project_comments', ['comment_body' => 'Please, can we just go back and get the Toshiba Handibook?'])
            ->see('Comment submitted')
            ->see('Please, can we just go back and get the Toshiba Handibook?')
            ->see('comment-edit')
            ->see('comment-delete')
            ->see('submit-comment');

        //Delete comment
        $this->project->comments()->delete();
    }

    /**
     * Test submitting a comment and checking for database storage and view injection
     */
    public function testNonUserCommentView()
    {
        $this->actingAs($this->user)
            ->visit($this->project->getSlug())
            ->type('The most rewarding part was when he gave me my money.', 'comment_body')
            ->press('submit-comment')
            ->click('Sign out')
            ->visit($this->project->getSlug())
            ->see('The most rewarding part was when he gave me my money.')
            ->dontSee('comment-edit')
            ->dontSee('comment-delete')
            ->see('Warning')
            ->see('comment-login');

        //Delete comment
        $this->project->comments()->delete();
    }

    /**
     * Test deleting a comment and checking for database deletion and view injection
     */
    public function testDelete()
    {
        $this->actingAs($this->user)
            ->visit($this->project->getSlug())
            ->type('Screw you guys I\'m going home.', 'comment_body')
            ->press('submit-comment')
            ->press('comment-delete')
            ->dontSeeInDatabase('project_comments', ['comment_body' => 'Screw you guys I\'m going home.'])
            ->see('Comment deleted');
    }

    /**
     * Test editing a comment and checking for database update and view injection
     */
    public function testEdit()
    {
        $this->actingAs($this->user)
            ->visit($this->project->getSlug())
            ->type('Join the dark side.', 'comment_body')
            ->press('submit-comment')
            ->press('comment-edit')
            ->see('Edit Comment')
            ->see('Join the dark side.')
            ->type('No join the light side.', 'comment_body')
            ->press('submit-comment')
            ->seePageIs($this->project->getSlug())
            ->seeInDatabase('project_comments', ['comment_body' => 'No join the light side.'])
            ->dontSeeInDatabase('project_comments', ['comment_body' => 'Join the dark side.'])
            ->see('No join the light side.');

        //Delete comment
        $this->project->comments()->delete();
    }
}
