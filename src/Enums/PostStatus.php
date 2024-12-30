<?php

namespace App\Enums;

use Leocello\SweetEnum\SweetCase;
use Leocello\SweetEnum\SweetEnum;
use Leocello\SweetEnum\SweetEnumContract;

enum PostStatus: string implements SweetEnumContract
{
    use SweetEnum;

    #[SweetCase(
        title: 'Post is waiting for approval',
    )]
    case Pending = 'pending';

    #[SweetCase(
        title: 'Approved / published',
    )]
    case Approved = 'approved';

    #[SweetCase(
        title: 'Post was rejected',
    )]
    case Rejected = 'rejected';
}
