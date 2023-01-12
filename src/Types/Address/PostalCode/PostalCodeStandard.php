<?php declare(strict_types=1);

namespace Ecode\Types\Address\PostalCode;

interface PostalCodeStandard
{
    /**
     * @param string $value
     * @return bool
     */
    public static function isValid(string $value): bool;
}
