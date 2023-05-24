<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement;

use Ecode\Types\Numeric;
use Exception;

abstract class UnitOfMeasurement
{
    public readonly float|int $value;

    abstract public static function getSymbol(): string;

    abstract public static function getName(): string;

    abstract public static function getPlural(): string;

    protected function __construct(float|int $value)
    {
        $this->value = $value;
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

    public static function fromZero(): static
    {
        return new static(0);
    }

    public static function init(): static
    {
        return static::fromZero();
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function getHumansFormat(bool $abbreviated = true, int $maxDecimalPlaces = 2): string
    {
        $handledValue = (float)Numeric::numberFormat($this->value, $maxDecimalPlaces);

        if ($abbreviated) {
            return sprintf('%s %s', $handledValue, $this->getSymbol());
        }

        if ($handledValue == 1) {
            return sprintf('%s %s', $handledValue, strtolower($this->getName()));
        }

        return sprintf('%s %s', $handledValue, strtolower($this->getPlural()));
    }
}
