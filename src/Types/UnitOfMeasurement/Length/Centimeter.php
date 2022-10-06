<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement\Length;

use Ecode\Types\UnitOfMeasurement\UnitOfMeasurement;

final class Centimeter extends UnitOfMeasurement
{
    const NAME = 'Centimeter';
    const PLURAL = 'Centimeters';
    const SYMBOL = 'cm';

    /**
     * @param int|float $value
     * @return Centimeter
     */
    public static function fromMillimeters(int|float $value): Centimeter
    {
        return new Centimeter($value / 10);
    }

    /**
     * @param int|float|null $value
     * @return ?Centimeter
     */
    public static function innFromMillimeters(int|float|null $value): ?Centimeter
    {
        if (is_null($value)) return null;
        return new Centimeter($value / 10);
    }

    /**
     * @return int|float
     */
    public function toMillimeters(): int|float
    {
        return $this->value * 10;
    }

    /**
     * @param int|float $value
     * @return Centimeter
     */
    public static function fromMeters(int|float $value): Centimeter
    {
        return new Centimeter($value * 100);
    }

    /**
     * @param int|float|null $value
     * @return ?Centimeter
     */
    public static function innFromMeters(int|float|null $value): ?Centimeter
    {
        if (is_null($value)) return null;
        return new Centimeter($value * 100);
    }

    /**
     * @return int|float
     */
    public function toMeters(): int|float
    {
        return $this->value / 100;
    }

    /**
     * @param int|float $value
     * @return Centimeter
     */
    public static function fromInches(int|float $value): Centimeter
    {
        return new Centimeter($value * 2.54);
    }

    /**
     * @param int|float|null $value
     * @return ?Centimeter
     */
    public static function innFromInches(int|float|null $value): ?Centimeter
    {
        if (is_null($value)) return null;
        return new Centimeter($value * 2.54);
    }

    /**
     * @return int|float
     */
    public function toInches(): int|float
    {
        return $this->value / 2.54;
    }

    /**
     * @param int|float $value
     * @return Centimeter
     */
    public static function fromFeet(int|float $value): Centimeter
    {
        return new Centimeter($value * 30.48);
    }

    /**
     * @param int|float|null $value
     * @return ?Centimeter
     */
    public static function innFromFeet(int|float|null $value): ?Centimeter
    {
        if (is_null($value)) return null;
        return new Centimeter($value * 30.48);
    }

    /**
     * @return int|float
     */
    public function toFeet(): int|float
    {
        return $this->value / 30.48;
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
