<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfInformation;

class Megabyte extends UnitOfInformation
{
    const NAME = 'Megabyte';
    const PLURAL = 'Megabytes';
    const SYMBOL = 'MB';

    /**
     * @param int|float $value
     * @return static
     */
    public static function fromBytes(int|float $value): self
    {
        return new static($value / 1024 / 1024);
    }

    /**
     * @return int|float
     */
    public function toBytes(): int|float
    {
        return $this->value * 1024 * 1024;
    }

    /**
     * @param int|float $value
     * @return static
     */
    public static function fromKilobytes(int|float $value): self
    {
        return new static($value / 1024);
    }

    /**
     * @return int|float
     */
    public function toKilobytes(): int|float
    {
        return $this->value * 1024;
    }

    /**
     * @param int|float $value
     * @return static
     */
    public static function fromGigabytes(int|float $value): self
    {
        return new static($value * 1024);
    }

    /**
     * @return int|float
     */
    public function toGigabytes(): int|float
    {
        return $this->value / 1024;
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
