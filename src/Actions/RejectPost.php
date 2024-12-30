<?php

namespace App\Actions;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;

final readonly class RejectPost
{
    /**
     * @throws \Exception
     */
    public function __construct(private User $user, private Post $post)
    {
        $this->validateUserAccess();
    }

    /**
     * @throws \Exception
     */
    private function validateUserAccess(): void
    {
        if (!$this->user->accessType->canApprove()) {
            throw new \Exception('User cannot approve posts');
        }
    }

    public function __invoke(string $reason): Post
    {
        $this->post->status = PostStatus::Rejected;

        new NotifyWriter($this->post)();

        return $this->post;
    }
}
