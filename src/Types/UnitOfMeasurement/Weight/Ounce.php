<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement\Weight;

use Ecode\Types\UnitOfMeasurement\UnitOfMeasurement;

final class Ounce extends UnitOfMeasurement
{
    const NAME = 'Ounce';
    const PLURAL = 'Ounces';
    const SYMBOL = 'oz';

    /**
     * @param float|int $value
     * @return Ounce
     */
    public static function fromKilograms(float|int $value): Ounce
    {
        return new Ounce($value * 35.2739619496);
    }

    /**
     * @param float|int|null $value
     * @return ?Ounce
     */
    public static function innFromKilograms(float|int|null $value): ?Ounce
    {
        if (is_null($value)) return null;
        return new Ounce($value * 35.2739619496);
    }

    /**
     * @return Kilogram
     */
    public function toKilograms(): Kilogram
    {
        return Kilogram::fromOunces($this->value);
    }

    /**
     * @param float|int $value
     * @return Ounce
     */
    public static function fromGrams(float|int $value): Ounce
    {
        return new Ounce($value * 0.0352739619);
    }

    /**
     * @param float|int|null $value
     * @return ?Ounce
     */
    public static function innFromGrams(float|int|null $value): ?Ounce
    {
        if (is_null($value)) return null;
        return new Ounce($value * 0.0352739619);
    }

    /**
     * @return Gram
     */
    public function toGrams(): Gram
    {
        return Gram::fromOunces($this->value);
    }

    /**
     * @param float|int $value
     * @return Ounce
     */
    public static function fromPounds(float|int $value): Ounce
    {
        return new Ounce($value * 16);
    }

    /**
     * @param float|int|null $value
     * @return ?Ounce
     */
    public static function innFromPounds(float|int|null $value): ?Ounce
    {
        if (is_null($value)) return null;
        return new Ounce($value * 16);
    }

    /**
     * @return Pound
     */
    public function toPounds(): Pound
    {
        return Pound::fromOunces($this->value);
    }

    /**
     * @return string
     */
    public static function getSymbol(): string
    {
        return self::SYMBOL;
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return self::NAME;
    }

    /**
     * @return string
     */
    public static function getPlural(): string
    {
        return self::PLURAL;
    }
}
