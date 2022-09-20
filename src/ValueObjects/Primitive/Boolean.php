<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\Primitive;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\ValueObject;
use Throwable;

class Boolean extends ValueObject
{
    /**
     * @var bool
     */
    private bool $value;

    /**
     * @param bool $value
     */
    protected function __construct(bool $value)
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

    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        return is_bool($value);
    }

    /**
     * @param mixed $value
     * @return static
     * @throws InvalidValueHttpException
     */
    public static function from(mixed $value): static
    {
        if (!Boolean::isValid($value)) throw new InvalidValueHttpException("Invalid Boolean type.");
        return new Boolean($value);
    }

    /**
     * @param mixed $value
     * @return ?static
     */
    public static function tryFrom(mixed $value): ?static
    {
        try {
            return Boolean::from($value);
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
        return new Boolean($value);
    }
}
