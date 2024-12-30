<?php

namespace App\Actions;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;

final readonly class PublishPost
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
        if ($this->post->author->id === $this->user->id && $this->user->isTrusted()) {
            return;
        }

        if (!$this->user->accessType->canApprove()) {
            throw new \Exception('User cannot approve posts');
        }
    }

    public function __invoke(): Post
    {
        $this->post->status = PostStatus::Approved;

        new NotifyReaders($this->post)();

        if ($this->post->author->id !== $this->user->id) {
            new NotifyWriter($this->post)();
        }

        return $this->post;
    }
}
