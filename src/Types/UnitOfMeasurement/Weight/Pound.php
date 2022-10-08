<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement\Weight;

use Ecode\Types\UnitOfMeasurement\UnitOfMeasurement;

final class Pound extends UnitOfMeasurement
{
    const NAME = 'Pound';
    const PLURAL = 'Pounds';
    const SYMBOL = 'lbs';

    /**
     * @param float|int $value
     * @return Pound
     */
    public static function fromKilograms(float|int $value): Pound
    {
        return new Pound($value * 2.2046226218);
    }

    /**
     * @param float|int|null $value
     * @return ?Pound
     */
    public static function innFromKilograms(float|int|null $value): ?Pound
    {
        if (is_null($value)) return null;
        return new Pound($value * 2.2046226218);
    }

    /**
     * @return float|int
     */
    public function toKilograms(): float|int
    {
        return $this->value / 2.2046226218;
    }

    /**
     * @param float|int $value
     * @return Pound
     */
    public static function fromGrams(float|int $value): Pound
    {
        return new Pound($value / 453.59237);
    }

    /**
     * @param float|int|null $value
     * @return ?Pound
     */
    public static function innFromGrams(float|int|null $value): ?Pound
    {
        if (is_null($value)) return null;
        return new Pound($value / 453.59237);
    }

    /**
     * @return Gram
     */
    public function toGrams(): Gram
    {
        return Gram::fromPounds($this->value);
    }

    /**
     * @param float|int $value
     * @return Pound
     */
    public static function fromOunces(float|int $value): Pound
    {
        return new Pound($value / 16);
    }

    /**
     * @param float|int|null $value
     * @return ?Pound
     */
    public static function innFromOunces(float|int|null $value): ?Pound
    {
        if (is_null($value)) return null;
        return new Pound($value / 16);
    }

    /**
     * @return float|int
     */
    public function toOunces(): float|int
    {
        return $this->value * 16;
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
