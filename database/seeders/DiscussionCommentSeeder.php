<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscussionCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\DiscussionComment::create([
            'user_id' => 1,
            'discussion_id' => 1,
            'content' => "This platform is developed with the following concerns and considerations in my mind:<br > Need of platform which is unbiased where your ethnicity, nationality etc.. doesn't matter where the users are only united by the Islamic ideology irrespective of their sect and school-of-thought. Where students can debate on intellectual topics where AI moderate the community and useless content will be removed automatically to avoid cringe. Where student can propose solutions to the modern challenges they have where students can unite on global causes where students securely talk on the ground realities with even hiding their identity. And finally a platform that is not owned by the corporate companies. This platform is mean to bring the whole world ummah youth and students on a single page to spread awareness about the Islam and guide each other towards a strong Islamic community."
        ]);
    }
}
