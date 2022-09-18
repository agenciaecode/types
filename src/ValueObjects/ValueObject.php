<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects;

use Throwable;

abstract class ValueObject implements ValueObjectContract
{
    /**
     * @var mixed
     */
    protected mixed $value;

    /**
     * @param mixed $value
     * @return static
     */
    public static function from(mixed $value): static
    {
        return new static($value);
    }

    /**
     * @param mixed $value
     * @return ?static
     */
    public static function tryFrom(mixed $value): ?static
    {
        try {
            return new static($value);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @param mixed $value
     * @return ?static
     */
    public static function fromIfNotNull(mixed $value): ?static
    {
        if (is_null($value)) return null;
        return new static($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public static function cleanOnlyNumbers(string $value): string
    {
        return preg_replace(pattern: '/\D/i', replacement: '', subject: trim($value));
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }

    /**
     * @param ValueObjectContract $value
     * @return bool
     */
    public function equals(ValueObjectContract $value): bool
    {
        return $this === $this->value;
    }
}
