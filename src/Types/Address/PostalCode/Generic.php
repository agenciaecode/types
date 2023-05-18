<?php declare(strict_types=1);

namespace Ecode\Types\Address\PostalCode;

class Generic implements PostalCodeStandard
{
    public static function isValid(mixed $value): bool
    {
        return true;
    }
}