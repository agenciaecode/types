<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects;

class Boolean extends ValueObject
{
    /**
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value ? 'true' : 'false';
    }
}
