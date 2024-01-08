<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discussion = \App\Models\Discussion::create([
            'created_by' => 1,
            'title' => "What's the need of a of our own Students Portal?",
            'topics' => "transparency,anti-nationalism,one-united-ummah,open-source,self-sufficient"
        ]);
    }
}
