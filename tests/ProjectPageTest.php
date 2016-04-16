<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectPageTest extends TestCase
{
    private $user = null;
    private $entry = null;

    /**
     * Prepare for the test, creating a user and entry to work with during the test.
     */
    protected function setUp() {
        parent::setUp();

        // Ensure that the entry was deleted in the case of a failed test.
        $this->beforeApplicationDestroyed(function() {
            $this->entry->delete();
        });

        $this->user = factory(App\User::class)->make(['username' => 'test_user']);
        $this->entry = \App\Project::create([
            'author' => $this->user->username,
            'title' => 'Test Project',
            'description' => 'For testing',
            'body' => 'This is a simple test body'
        ]);
    }

    /**
     * Test the visibility of the buttons.
     *
     * @return void
     */
    public function testUserPermissions()
    {
        $this->visit($this->entry->getSlug())
            ->dontSeeLink('View Files')
            ->dontSeeLink('Delete');

        $this->actingAs($this->user)
            ->visit($this->entry->getSlug())
            ->seeLink('View Files')
            ->seeLink('Delete');
    }

    /**
     * Test the delete button & functionality as the author.
     */
    public function testDelete()
    {
        $this->actingAs($this->user)
            ->visit($this->entry->getSlug())
            ->click('Delete')
            ->seePageIs('/projects')
            ->dontSeeInDatabase('projects', ['title' => 'Test Project']);
    }

    /**
     * Test a user "spoofing" the delete link, should return a 403.
     */
    public function testForbiddenDirectDelete()
    {
        $this->actingAs(factory(App\User::class)->make(['username' => 'other_user']))
            ->get($this->entry->getSlug() . '/delete')
            ->assertResponseStatus(403);
    }

    /**
     * Test view files button. 
     */
    public function testViewFilesLink()
    {
        $this->actingAs($this->user)
            ->visit($this->entry->getSlug())
            ->click('View Files');
    }
}
