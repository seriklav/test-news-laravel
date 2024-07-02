<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
/**
 * @method static int ACTIVE()
 * @method static int HIDDEN()
 */
class NewsStatusEnum extends Enum implements LocalizedEnum
{
	public const ACTIVE = 1;
	public const HIDDEN = 2;

    public static function parseDatabase($value): int
    {
        return (int) $value;
    }
}
