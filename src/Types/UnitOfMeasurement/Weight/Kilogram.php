<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement\Weight;

use Ecode\Types\UnitOfMeasurement\UnitOfMeasurement;

final class Kilogram extends UnitOfMeasurement
{
    const NAME = 'Kilogram';
    const PLURAL = 'Kilograms';
    const SYMBOL = 'kg';

    public static function fromGrams(float|int $value): Kilogram
    {
        return new Kilogram($value / 1000);
    }

    public static function innFromGrams(float|int|null $value): ?Kilogram
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilogram($value / 1000);
    }

    public function toGrams(): Gram
    {
        return Gram::fromKilograms($this->value);
    }

    public static function fromPounds(float|int $value): Kilogram
    {
        return new Kilogram($value * 0.45359237);
    }

    public static function innFromPounds(float|int|null $value): ?Kilogram
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilogram($value * 0.45359237);
    }

    public function toPounds(): Pound
    {
        return Pound::fromKilograms($this->value);
    }

    public static function fromOunces(float|int $value): Kilogram
    {
        return new Kilogram($value * 0.0283495231);
    }

    public static function innFromOunces(float|int|null $value): ?Kilogram
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilogram($value * 0.0283495231);
    }

    public function toOunces(): Ounce
    {
        return Ounce::fromKilograms($this->value);
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
