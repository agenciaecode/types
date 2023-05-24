<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement\Weight;

final class Pound extends Weight
{
    const NAME = 'Pound';
    const PLURAL = 'Pounds';
    const SYMBOL = 'lbs';

    public static function fromKilograms(float|int $value): Pound
    {
        return new Pound($value * 2.2046226218);
    }

    public static function innFromKilograms(float|int|null $value): ?Pound
    {
        if (is_null($value)) {
            return null;
        }

        return new Pound($value * 2.2046226218);
    }

    public function toKilograms(): float|int
    {
        return $this->value / 2.2046226218;
    }

    public static function fromGrams(float|int $value): Pound
    {
        return new Pound($value / 453.59237);
    }

    public static function innFromGrams(float|int|null $value): ?Pound
    {
        if (is_null($value)) {
            return null;
        }

        return new Pound($value / 453.59237);
    }

    public function toGrams(): Gram
    {
        return Gram::fromPounds($this->value);
    }

    public static function fromOunces(float|int $value): Pound
    {
        return new Pound($value / 16);
    }

    public static function innFromOunces(float|int|null $value): ?Pound
    {
        if (is_null($value)) {
            return null;
        }

        return new Pound($value / 16);
    }

    public function toOunces(): float|int
    {
        return $this->value * 16;
    }

    public static function getSymbol(): string
    {
        return self::SYMBOL;
    }

    public static function getName(): string
    {
        return self::NAME;
    }

    public static function getPlural(): string
    {
        return self::PLURAL;
    }

    protected function normalize(Weight|float|int $value): float|int
    {
        // TODO: Implement normalize() method.
    }
}
