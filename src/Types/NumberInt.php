<?php declare(strict_types=1);

namespace Ecode\Types;

final class NumberInt extends Numeric
{
    protected function __construct(int $value)
    {
        parent::__construct($value);
    }

    public static function isValid(mixed $value): bool
    {
        return is_int($value);
    }
}