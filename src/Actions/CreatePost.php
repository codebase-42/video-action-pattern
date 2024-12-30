<?php

namespace App\Actions;

use App\Models\Post;
use App\Models\User;

final readonly class CreatePost
{
    /**
     * @throws \Exception
     */
    public function __construct(private User $user)
    {
        $this->validateUserAccess();
    }

    /**
     * @throws \Exception
     */
    private function validateUserAccess(): void
    {
        if (!$this->user->accessType->canWrite()) {
            throw new \Exception('User cannot write posts');
        }
    }

    /**
     * @throws \Exception
     */
    public function __invoke(string $title, string $body): Post
    {
        $post = new Post;
        $post->title = $title;
        $post->body = $body;
        $post->author = $this->user;
        $post->save();

        if ($this->user->isTrusted()) {
            return new PublishPost($this->user, $post)();
        }

        new NotifyApprovers($post)();

        return $post;
    }
}
