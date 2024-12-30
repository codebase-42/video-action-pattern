<?php

namespace App\Actions;

use App\Enums\PostStatus;
use App\Models\Post;

final readonly class NotifyWriter
{
    public function __construct(private Post $post)
    {
    }

    public function __invoke(): void
    {
        if ($this->post->status->is(PostStatus::Approved)) {
            /// Send notification of post approved

            return;
        }

        if ($this->post->status->is(PostStatus::Rejected)) {
            /// Send notification of post rejected

            return;
        }

        /// Do something else?
    }
}
