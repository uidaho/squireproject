<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

abstract class MassSeeder extends Seeder
{
    protected $faker = null;

    protected $configKey = 'MassSeederFallback';

    protected $message = 'How many entries should I create?';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker\Factory::create();
        $this->setup();

        $times = $this->getNumberIterations();
        $bar = $this->command->getOutput()->createProgressBar($times);
        $bar->start();

        for ($i = 0; $i < $times; $i++) {
            echo ' ';
            $this->seed($i);

            $bar->advance();
        }

        $bar->finish();
        echo PHP_EOL . PHP_EOL;
    }

    /**
     * Perform assignments need between loops.
     *
     * @return mixed
     */
    protected abstract function setup();

    /**
     * Abstract function for the seed functionality. One iteration
     * of seeding should be carried out within.
     *
     * @param $iteration String: the current iteration
     * @return mixed
     */
    public abstract function seed($iteration);

    /**
     * Gets the number of iterations for seeding by checking if we are in
     * the testing environment, otherwise falling back to the prompt.
     *
     * This method can be overriden to provide a absolute number of
     * iterations.
     *
     * @return string
     */
    protected function getNumberIterations()
    {
        if ($this->isTravis()) {
            return $this->getNumberIterationsFromConfig();
        } else {
            $input = $this->prompt($this->message);
            assert(is_numeric($input) && $input > 0, "Must provide a positive integer.");
            return $input;
        }
    }

    /**
     * Checks to see if we're in the testing environment.
     *
     * @return bool T/F testing
     */
    protected function isTravis() {
        return App::environment() == 'testing';
    }

    /**
     * Gets the number of iterations from the config.
     *
     * @return mixed
     */
    protected function getNumberIterationsFromConfig()
    {
        return Config::get('app.travis.' . $this->configKey);
    }

    /**
     * Prompts the user for input with the given message.
     *
     * @param $message
     * @return string
     */
    protected function prompt($message)
    {
        return $this->command->ask($message);
    }
}
