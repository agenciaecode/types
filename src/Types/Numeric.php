<?php declare(strict_types=1);

namespace Ecode\Types;

use Exception;

class Numeric
{
    /**
     * @var float|int
     */
    protected float|int $value;

    /**
     * @param float|int $value
     */
    protected function __construct(float|int $value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        return is_float($value) || is_int($value);
    }

    /**
     * @param float|int $value
     * @return static
     */
    public static function from(float|int $value): static
    {
        return new static($value);
    }

    /**
     * @param float|int $value
     * @return ?static
     */
    public static function tryFrom(float|int $value): ?static
    {
        try {
            return new static($value);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @param float|int|null $value
     * @return ?static
     */
    public static function innFrom(float|int|null $value): ?static
    {
        if (is_null($value)) return null;
        return new static($value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    /**
     * @return float|int
     */
    public function getValue(): float|int
    {
        return $this->value;
    }

    /**
     * @param self $value
     * @return bool
     */
    public function equals(self $value): bool
    {
        return $this->getValue() === $value->getValue();
    }
}
