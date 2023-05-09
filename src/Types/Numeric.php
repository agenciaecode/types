<?php declare(strict_types=1);

namespace Ecode\Types;

use Exception;

class Numeric
{
    /**
     * @var float|int
     */
    public readonly float|int $value;

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
        return (string)$this->value;
    }

    /**
     * @param self $value
     * @return bool
     */
    public function equals(self $value): bool
    {
        return $this->value === $value->value;
    }

    /**
     * @param float $value
     * @param int $decimalPlaces
     * @param string $decimalSeparator
     * @param string $thousandsSeparator
     * @return string
     */
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

    /**
     * @param int $decimalPlaces
     * @param string $decimalSeparator
     * @param string $thousandsSeparator
     * @return string
     */
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
}
