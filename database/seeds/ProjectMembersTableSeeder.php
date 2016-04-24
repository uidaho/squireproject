<?php

use Illuminate\Database\Seeder;
use App\ProjectMember;

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
