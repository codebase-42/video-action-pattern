<?php

namespace App\Commands;

use App\Actions\NotifyApprovers;
use App\Models\Post;

class RemindAll
{
    public function run(): void
    {
        $posts = Post::getAllPending();

        foreach ($posts as $post) {
            new NotifyApprovers($post)();
        }
    }
}
