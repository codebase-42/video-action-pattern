<?php

namespace App\Models;

use App\Enums\PostStatus;

class Post
{
    private(set) int $id;
    public string $title;
    public string $body;
    public PostStatus $status;
    public User $author;

    public function save(): void
    {
        /// Saves in database
    }

    /**
     * @return static[]
     */
    public static function getAllPending(): array
    {
        ///
        return [];
    }
}
