<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects;

abstract class ValueObject implements ValueObjectContract
{
    /**
     * @param ValueObjectContract $value
     * @return bool
     */
    public function equals(ValueObjectContract $value): bool
    {
        return $this === $value;
    }
}
