<?php declare(strict_types=1);

namespace Ecode\Types\Address\PostalCode;

class Generic implements PostalCodeStandard
{
    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        return true;
    }
}