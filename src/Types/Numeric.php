<?php declare(strict_types=1);

namespace Ecode\Types;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Exception;

class Numeric
{
    public readonly float|int $value;

    protected function __construct(float|int $value)
    {
        $this->value = $value;
    }

    public static function isValid(mixed $value): bool
    {
        return is_float($value) || is_int($value);
    }

    public static function from(float|int $value): static
    {
        return new static($value);
    }

    public static function tryFrom(float|int $value): ?static
    {
        try {
            return new static($value);
        } catch (Exception) {
            return null;
        }
    }

    public static function innFrom(float|int|null $value): ?static
    {
        if (is_null($value)) {
            return null;
        }

        return new static($value);
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function equals(self $value): bool
    {
        return $this->value === $value->value;
    }

    public static function numberFormat(
        float $value,
        int $decimalPlaces = 2,
        string $decimalSeparator = '.',
        string $thousandsSeparator = '',
    ): string
    {
        return number_format(
            num: $value,
            decimals: $decimalPlaces,
            decimal_separator: $decimalSeparator,
            thousands_separator: $thousandsSeparator
        );
    }

    public function format(
        int $decimalPlaces = 2,
        string $decimalSeparator = '.',
        string $thousandsSeparator = '',
    ): string
    {
        return self::numberFormat(
            value: $this->value,
            decimalPlaces: $decimalPlaces,
            decimalSeparator: $decimalSeparator,
            thousandsSeparator: $thousandsSeparator
        );
    }

    public static function fromZero(): static
    {
        return new static(0);
    }

    public static function init(): static
    {
        return self::fromZero();
    }

    /**
     * @throws Exception
     */
    private function normalize(float|int|self $value): float|int
    {
        if (is_int($value) || is_float($value)) {
            return $value;
        }

        if (get_class($value) === static::class) {
            return $value->value;
        }

        throw new InvalidTypeHttpException(message: sprintf(
            'Only int, float and %s are accepted in this operation.',
            static::class
        ));
    }

    /**
     * @throws Exception
     */
    public function sum(float|int|self $value): static
    {
        return new static($this->value + self::normalize($value));
    }

    /**
     * @throws Exception
     */
    public function minus(float|int|self $value): static
    {
        return new static($this->value - self::normalize($value));
    }

    /**
     * @throws Exception
     */
    public function multiply(float|int|self $multiplier): static
    {
        return new static($this->value * self::normalize($multiplier));
    }

    /**
     * @throws Exception
     */
    public function divide(float|int|self $divisor): static
    {
        return new static($this->value / self::normalize($divisor));
    }

    /**
     * @throws Exception
     */
    public function lessThan(float|int|self $value): bool
    {
        return $this->value < self::normalize($value);
    }

    /**
     * @throws Exception
     */
    public function lessThanOrEqualTo(float|int|self $value): bool
    {
        return $this->value <= self::normalize($value);
    }

    /**
     * @throws Exception
     */
    public function greaterThan(float|int|self $value): bool
    {
        return $this->value > self::normalize($value);
    }

    /**
     * @throws Exception
     */
    public function greaterThanOrEqualTo(float|int|self $value): bool
    {
        return $this->value >= self::normalize($value);
    }

    /**
     * @throws Exception
     */
    public function equalTo(float|int|self $value): bool
    {
        return $this->value === self::normalize($value);
    }

    /**
     * @throws Exception
     */
    public function notEqualTo(float|int|self $value): bool
    {
        return $this->value !== self::normalize($value);
    }

    /**
     * @throws Exception
     */
    public function between(float|int|self $minValue, float|int|self $maxValue): bool
    {
        return $this->value > self::normalize($minValue) && $this->value < self::normalize($maxValue);
    }

    /**
     * @throws Exception
     */
    public function betweenOrEqualThen(float|int|self $minValue, float|int|self $maxValue): bool
    {
        return $this->value >= self::normalize($minValue) && $this->value <= self::normalize($maxValue);
    }

    public function percentage(float|int $ratio): static
    {
        return new static($this->value / 100 * $ratio);
    }

    public function sumPercentage(float|int $ratio): static
    {
        return new static($this->value + ($this->value / 100 * $ratio));
    }

    public function minusPercentage(float|int $ratio): static
    {
        return new static($this->value - ($this->value / 100 * $ratio));
    }

    /**
     * @throws Exception
     */
    public function percentageRatio(float|int|self $value): float|int
    {
        return self::normalize($value) / $this->value * 100;
    }

    public static function convertToPositive(float|int $value): float|int
    {
        return abs($value);
    }

    public static function convertToNegative(float|int $value): float|int
    {
        return -abs($value);
    }

    public static function convertToInverse(float|int $value): float|int
    {
        return $value * (-1);
    }

    public function toPositive(): static
    {
        return new static(self::convertToPositive($this->value));
    }

    public function toNegative(): static
    {
        return new static(self::convertToNegative($this->value));
    }

    public function toInverse(): static
    {
        return new static(self::convertToInverse($this->value));
    }

    public static function valueIsNeutral(float|int $value): bool
    {
        return $value == 0;
    }

    public static function valueIsPositive(float|int $value): bool
    {
        return $value > 0;
    }

    public static function valueIsNegative(float|int $value): bool
    {
        return $value < 0;
    }

    public function isNeutral(): bool
    {
        return self::valueIsNeutral($this->value);
    }

    public function isPositive(): bool
    {
        return self::valueIsPositive($this->value);
    }

    public function isNegative(): bool
    {
        return self::valueIsNegative($this->value);
    }
}
