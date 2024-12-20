<?php

namespace App\Models;

use Enums\UserAccessType;

class User
{
    private(set) int $id;
    public string $name;
    public UserAccessType $accessType = UserAccessType::DEFAULT;

    public function isTrusted(): bool
    {
        /// If user has more than x published posts, return true - or some other logic

        return false;
    }
}
