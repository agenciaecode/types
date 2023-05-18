<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement\Weight;

use Ecode\Types\UnitOfMeasurement\UnitOfMeasurement;

final class Ounce extends UnitOfMeasurement
{
    const NAME = 'Ounce';
    const PLURAL = 'Ounces';
    const SYMBOL = 'oz';

    public static function fromKilograms(float|int $value): Ounce
    {
        return new Ounce($value * 35.2739619496);
    }

    public static function innFromKilograms(float|int|null $value): ?Ounce
    {
        if (is_null($value)) {
            return null;
        }

        return new Ounce($value * 35.2739619496);
    }

    public function toKilograms(): Kilogram
    {
        return Kilogram::fromOunces($this->value);
    }

    public static function fromGrams(float|int $value): Ounce
    {
        return new Ounce($value * 0.0352739619);
    }

    public static function innFromGrams(float|int|null $value): ?Ounce
    {
        if (is_null($value)) {
            return null;
        }

        return new Ounce($value * 0.0352739619);
    }

    public function toGrams(): Gram
    {
        return Gram::fromOunces($this->value);
    }

    public static function fromPounds(float|int $value): Ounce
    {
        return new Ounce($value * 16);
    }

    public static function innFromPounds(float|int|null $value): ?Ounce
    {
        if (is_null($value)) {
            return null;
        }

        return new Ounce($value * 16);
    }

    public function toPounds(): Pound
    {
        return Pound::fromOunces($this->value);
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
