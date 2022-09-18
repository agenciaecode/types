<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\UnitOfMeasurement\Length;

use Mkioschi\ValueObjects\ValueObject;

class Centimeter extends ValueObject
{
    /**
     * @param int|float $value
     */
    public function __construct(int|float $value)
    {
        $this->value = $value;
    }

    /**
     * @param int|float $value
     * @return static
     */
    public static function fromMillimeters(int|float $value): self
    {
        return new static($value / 10);
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
     * @return static
     */
    public static function fromMeters(int|float $value): self
    {
        return new static($value * 100);
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
     * @return static
     */
    public static function fromInches(int|float $value): self
    {
        return new static($value * 2.54);
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
     * @return static
     */
    public static function fromFeet(int|float $value): self
    {
        return new static($value * 30.48);
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
    public function __toString(): string
    {
        return (string)$this->value;
    }
}
