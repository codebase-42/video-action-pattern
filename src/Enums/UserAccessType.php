<?php

namespace Enums;

use Leocello\SweetEnum\SweetCase;
use Leocello\SweetEnum\SweetEnum;
use Leocello\SweetEnum\SweetEnumContract;

/**
 * @method bool canWrite()
 * @method bool canApprove()
 */
enum UserAccessType: string implements SweetEnumContract
{
    use SweetEnum;

    public const UserAccessType DEFAULT = self::Reader;

    #[SweetCase(
        canWrite: false,
        canApprove: false,
    )]
    case Reader = 'reader';

    #[SweetCase(
        canWrite: true,
        canApprove: false,
    )]
    case Writer = 'writer';

    #[SweetCase(
        canWrite: true,
        canApprove: true,
    )]
    case Editor = 'editor';

    #[SweetCase(
        canWrite: false,
        canApprove: true,
    )]
    case Publisher = 'publisher';
}
