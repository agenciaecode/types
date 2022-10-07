<?php declare(strict_types=1);

namespace Ecode\Types;

final class Integer extends Numeric
{
    /**
     * @param int $value
     */
    protected function __construct(int $value)
    {
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        return is_int($value);
    }
}