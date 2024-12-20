<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function create(string $title, string $body): array
    {
        if (!$this->loggedUser->accessType->canWrite()) {
            throw new \Exception('User cannot write posts');
        }

        $post = new Post;
        $post->title = $title;
        $post->body = $body;
        $post->author = $this->loggedUser;
        $post->save();

        if ($this->loggedUser->isTrusted()) {
            $post->publish();
            $post->notifyReaders();
        } else {
            $post->notifyApprovers();
        }

        return [
            ///
        ];
    }

    /**
     * @throws \Throwable
     */
    public function approve(Post $post): array
    {
        if (!$this->loggedUser->accessType->canApprove()) {
            throw new \Exception('User cannot approve posts');
        }

        $post->publish();
        $post->notifyReaders();
        $post->notifyWriterApproval();

        return [
            ///
        ];
    }

    /**
     * @throws \Throwable
     */
    public function reject(Post $post, string $reason): array
    {
        if (!$this->loggedUser->accessType->canApprove()) {
            throw new \Exception('User cannot reject posts');
        }

        $post->reject();
        $post->notifyWriterRejection($reason);

        return [
            ///
        ];
    }

    public function remindApprovers(Post $post): array
    {
        $post->notifyApprovers();

        return [
            ///
        ];
    }

    /**
     * @throws \Exception
     */
    public function approveAll(): array
    {
        if (!$this->loggedUser->accessType->canApprove()) {
            throw new \Exception('User cannot approve posts');
        }

        $posts = Post::all();

        foreach ($posts as $post) {
            $post->publish();
            $post->notifyReaders();
            $post->notifyWriterApproval();
        }

        return [
            ///
        ];
    }

    /**
     * @throws \Exception
     */
    public function rejectAll(string $reason): array
    {
        if (!$this->loggedUser->accessType->canApprove()) {
            throw new \Exception('User cannot reject posts');
        }

        $posts = Post::all();

        foreach ($posts as $post) {
            $post->reject();
            $post->notifyWriterRejection($reason);
        }

        return [
            ///
        ];
    }
}
