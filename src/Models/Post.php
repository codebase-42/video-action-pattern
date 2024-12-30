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

    public function publish(): void
    {
        $this->status = PostStatus::Approved;
    }

    public function reject(): void
    {
        $this->status = PostStatus::Rejected;
    }

    public function notifyReaders(): void
    {
        /// Send notification to all readers of that a new post has arrived
    }

    public function notifyApprovers(): void
    {
        /// Send notification to all users that can approve
    }

    public function notifyWriterApproval(): void
    {
        /// Send notification to writer that their post has been approved
    }

    public function notifyWriterRejection(string $reason): void
    {
        /// Send notification to writer that their post has been approved
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
