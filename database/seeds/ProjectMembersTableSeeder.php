<?php

use Illuminate\Database\Seeder;
use App\ProjectMember;

/**
 * Class ProjectMemberTableSeeder
 *
 * Calls the factory to create project requests
 *
 * @author Robert Breckenridge (original)
 */
class ProjectMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProjectMember::class, 1)->create();
    }
}
