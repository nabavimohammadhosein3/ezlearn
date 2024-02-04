<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create(['name' => 'programming']);
        Group::create(['name' => 'graphic']);

        Group::create(['name' => 'web develop', 'parent_id' => 1]);
        Group::create(['name' => 'mobile develop', 'parent_id' => 1]);
        Group::create(['name' => 'software develop', 'parent_id' => 1]);
        Group::create(['name' => 'game develop', 'parent_id' => 1]);

        Group::create(['name' => '3d design', 'parent_id' => 2]);
        Group::create(['name' => '2d design', 'parent_id' => 2]);
        Group::create(['name' => 'videos', 'parent_id' => 2]);

        Group::create(['name' => 'front end', 'parent_id' => 3]);
        Group::create(['name' => 'back end', 'parent_id' => 3]);
    }
}
