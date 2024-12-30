<?php

namespace App\Actions;

use App\Enums\PostStatus;
use App\Models\Post;

final readonly class NotifyReaders
{
    public function __construct(private Post $post)
    {
    }

    public function __invoke(): void
    {
        if ($this->post->status->is(PostStatus::Approved)) {
            /// Send notification

            return;
        }

        /// Do something else?
    }
}
