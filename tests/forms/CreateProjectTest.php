<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class CreateProjectTest extends TestCase  // disable bad failing test, confirmed not working
{

    private $user = null;
    private $baseImagePath = '';
    private $testImage = '';

    protected function setUp() {
        parent::setUp();

        $callback = function() {
            $entry = App\Project::where('author', '=', 'test_user');
            if (isset($entry)) {
                $entry->delete();
            }
        };

        $this->afterApplicationCreated($callback);
        $this->beforeApplicationDestroyed($callback);

        $this->user = factory(App\User::class)->make(['username' => 'test_user']);
        $this->baseImagePath = base_path() . '/public/images';

        $this->testImage = base_path() . '/public/images/test-project-image.jpg';
    }
    /**
     * Tests creating a project
     *
     * @return void
     */
    public function testCreateProject()
    {
        $this->visit('/project/create')
            ->seePageIs('/login');

        $this->assertTrue(file_exists($this->testImage));

        // Create and retrieve good project
        $this->tryCreateProject($this->user,
            'Test Project',
            'Create test please work',
            'This is not the body you are looking for. This is not the body you are looking for. This is not the body you are looking for. This is not the body you are looking for. This is not the body you are looking for. ',
            $this->testImage
        )->seePageIs('/project/Test-Project');
        $entry = App\Project::where('title', '=', 'Test Project')->first();
        $this->assertTrue($entry != null);
        $this->seePageIs($entry->getSlug());

        // Check if image exists
        $imagePath = $this->baseImagePath . '/projects/product' . $entry->id . '.jpg';
        $this->assertTrue(file_exists($imagePath));

        // Delete project (using model's delete function)
        $entry->delete();
        $this->assertTrue(!file_exists($imagePath));
    }

    /**
     * Tests validation of title in form
     */
    public function testTitle()
    {
        $this->tryCreateProject($this->user, '', 'Create test!', str_repeat('The chips are the only way. ', 10), $this->testImage)
            ->seePageIs('/project/create');
    }

    /**
     * Tests validation of description in form
     */
    public function testDescription()
    {
        $this->tryCreateProject($this->user, 'Test Project', '', str_repeat('Dog spelled backwards is god.', 10), $this->testImage)
            ->seePageIs('/project/create');
    }

    /**
     * Tests validation of body in form.
     */
    public function testBody()
    {
        $this->tryCreateProject($this->user, 'Test Project', 'Create test!', '', $this->testImage)
            ->seePageIs('/project/create');
    }

    /**
     * Tests validation of image in form
     */
    public function testImage()
    {
        $this->tryCreateProject($this->user, 'Test Project', 'Create test!', str_repeat('Frog spelled forwards is frog.', 10), '')
            ->seePageIs('/project/create');
    }

    /**
     * Helper function for filling out the form.
     *
     * @param $user
     * @param $title
     * @param $description
     * @param $body
     * @param $image
     * @return $this
     */
    private function tryCreateProject($user, $title, $description, $body, $image)
    {
        return $this->actingAs($user)
            ->visit('/project/create')
            ->type($title, 'title')
            ->type($description, 'description')
            ->type($body, 'project-body')
            ->attach($image, 'thumbnail')
            ->press('submit');
    }
}
