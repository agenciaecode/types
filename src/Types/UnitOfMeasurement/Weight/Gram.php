<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement\Weight;

use Ecode\Types\UnitOfMeasurement\UnitOfMeasurement;

final class Gram extends UnitOfMeasurement
{
    const NAME = 'Gram';
    const PLURAL = 'Grams';
    const SYMBOL = 'g';

    public static function fromKilograms(float|int $value): Gram
    {
        return new Gram($value * 1000);
    }

    public static function innFromKilograms(float|int|null $value): ?Gram
    {
        if (is_null($value)) {
            return null;
        }

        return new Gram($value * 1000);
    }

    public function toKilograms(): float|int
    {
        return $this->value / 1000;
    }

    public static function fromPounds(float|int $value): Gram
    {
        return new Gram($value * 453.59237);
    }

    public static function innFromPounds(float|int|null $value): ?Gram
    {
        if (is_null($value)) {
            return null;
        }

        return new Gram($value * 453.59237);
    }

    public function toPounds(): Pound
    {
        return Pound::fromGrams($this->value);
    }

    public static function fromOunces(float|int $value): Gram
    {
        return new Gram($value * 28.349523125);
    }

    public static function innFromOunces(float|int|null $value): ?Gram
    {
        if (is_null($value)) {
            return null;
        }

        return new Gram($value * 28.349523125);
    }

    public function toOunces(): float|int
    {
        return $this->value / 28.349523125;
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
}
