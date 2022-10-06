<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement\Weight;

use Ecode\Types\UnitOfMeasurement\UnitOfMeasurement;

final class Gram extends UnitOfMeasurement
{
    const NAME = 'Gram';
    const PLURAL = 'Grams';
    const SYMBOL = 'g';

    /**
     * @param float|int $value
     * @return Gram
     */
    public static function fromKilograms(float|int $value): Gram
    {
        return new Gram($value * 1000);
    }

    /**
     * @param float|int|null $value
     * @return ?Gram
     */
    public static function innFromKilograms(float|int|null $value): ?Gram
    {
        if (is_null($value)) return null;
        return new Gram($value * 1000);
    }

    /**
     * @return float|int
     */
    public function toKilograms(): float|int
    {
        return $this->value / 1000;
    }

    /**
     * @param float|int $value
     * @return Gram
     */
    public static function fromPounds(float|int $value): Gram
    {
        return new Gram($value * 453.59237);
    }

    /**
     * @param float|int|null $value
     * @return ?Gram
     */
    public static function innFromPounds(float|int|null $value): ?Gram
    {
        if (is_null($value)) return null;
        return new Gram($value * 453.59237);
    }

    /**
     * @return float|int
     */
    public function toPounds(): float|int
    {
        return $this->value / 453.59237;
    }

    /**
     * @param float|int $value
     * @return Gram
     */
    public static function fromOunces(float|int $value): Gram
    {
        return new Gram($value * 28.349523125);
    }

    /**
     * @param float|int|null $value
     * @return ?Gram
     */
    public static function innFromOunces(float|int|null $value): ?Gram
    {
        if (is_null($value)) return null;
        return new Gram($value * 28.349523125);
    }

    /**
     * @return float|int
     */
    public function toOunces(): float|int
    {
        return $this->value / 28.349523125;
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
