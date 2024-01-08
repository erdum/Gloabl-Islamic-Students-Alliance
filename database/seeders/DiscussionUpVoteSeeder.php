<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscussionUpVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\DiscussionUpVote::insert([
            [
                'user_id' => 2,
                'discussion_id' => 1
            ],
            [
                'user_id' => 3,
                'discussion_id' => 1
            ]
        ]);
    }
}
