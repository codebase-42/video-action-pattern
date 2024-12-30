<?php

namespace App\Http\Controllers;

use App\Actions\CreatePost;
use App\Actions\NotifyApprovers;
use App\Actions\PublishPost;
use App\Actions\RejectPost;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function create(string $title, string $body): array
    {
        $createPost = new CreatePost($this->loggedUser);
        $post = $createPost($title, $body);

        return [
            ///
        ];
    }

    /**
     * @throws \Throwable
     */
    public function approve(Post $post): array
    {
        $publishPost = new PublishPost($this->loggedUser, $post);
        $publishPost();

        return [
            ///
        ];
    }

    /**
     * @throws \Throwable
     */
    public function reject(Post $post, string $reason): array
    {
        $publishPost = new RejectPost($this->loggedUser, $post);
        $publishPost($reason);

        return [
            ///
        ];
    }

    public function remindApprovers(Post $post): array
    {
        new NotifyApprovers($post)();

        return [
            ///
        ];
    }

    public function remindApproversOfAllPending(): array
    {
        $posts = Post::getAllPending();

        foreach ($posts as $post) {
            new NotifyApprovers($post)();
        }

        return [
            ///
        ];
    }

    /**
     * @throws \Exception
     */
    public function approveAllPending(): array
    {
        if (!$this->loggedUser->accessType->canApprove()) {
            throw new \Exception('User cannot approve posts');
        }

        $posts = Post::getAllPending();

        foreach ($posts as $post) {
            new PublishPost($this->loggedUser, $post)();
        }

        return [
            ///
        ];
    }

    /**
     * @throws \Exception
     */
    public function rejectAllPending(string $reason): array
    {
        if (!$this->loggedUser->accessType->canApprove()) {
            throw new \Exception('User cannot reject posts');
        }

        $posts = Post::getAllPending();

        foreach ($posts as $post) {
            new RejectPost($this->loggedUser, $post)($reason);
        }

        return [
            ///
        ];
    }
}
