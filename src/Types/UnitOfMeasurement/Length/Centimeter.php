<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfMeasurement\Length;

use Mkioschi\Types\Numeric;

final class Centimeter extends Numeric
{
    /**
     * @param int|float $value
     */
    protected function __construct(int|float $value)
    {
        parent::__construct($value);
    }

    /**
     * @param int|float $value
     * @return Centimeter
     */
    public static function fromMillimeters(int|float $value): Centimeter
    {
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
     * @return int|float
     */
    public function toFeet(): int|float
    {
        return $this->value / 30.48;
    }
}
