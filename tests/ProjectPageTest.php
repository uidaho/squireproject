<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectPageTest extends TestCase
{
    private $user = null;
    private $entry = null;
    private $member = null;

    /**
     * Prepare for the test, creating a user and entry to work with during the test.

    protected function setUp() {
        parent::setUp();

        // Ensure that the entry was deleted in the case of a failed test.
        $this->beforeApplicationDestroyed(function() {
            $this->entry->delete();
            $this->user->delete();
        });

        $this->user = factory(App\User::class)->create([
            'username' => 'test_user',
            'email' => 'temp117@temp.com',
            'password' => 'password'
        ]);

        $this->entry = \App\Project::create([
            'author' => $this->user->username,
            'user_id' => $this->user->id,
            'title' => 'Test Project',
            'description' => 'For testing',
            'body' => 'This is a simple test body'
        ]);

        $this->member = \App\ProjectMember::create([
            'user_id' => $this->user->id,
            'project_id' => $this->entry->id,
            'admin' => true
        ]);
        $this->entry->members()->save($this->member);
    }

    /**
     * Test the visibility of the buttons.
     *
     * @return void

    public function testUserPermissions()
    {
        $this->visit($this->entry->getSlug())
            ->dontSeeLink('Members Page')
            ->dontSeeLink('Delete');

        $this->actingAs($this->user)
            ->visit($this->entry->getSlug())
            ->seeLink('Members Page')
            ->seeLink('Delete');
    }

    /**
     * Test the delete button & functionality as the author.

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

    public function testForbiddenDirectDelete()
    {
        $this->actingAs(factory(App\User::class)->make(['username' => 'other_user']))
            ->get('/project/delete/' . $this->entry->getSlugFriendlyTitle())
            ->see('403');
    }

    /**
     * Test members page button.

    public function testMembersPageLink()
    {
        $this->actingAs($this->user)
            ->visit($this->entry->getSlug())
            ->click('Members Page');
   }*/
}
