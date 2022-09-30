<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfInformation;

class Kilobyte extends UnitOfInformation
{
    const NAME = 'Kilobyte';
    const PLURAL = 'Kilobytes';
    const SYMBOL = 'KB';

    /**
     * @param int|float $value
     * @return static
     */
    public static function fromBytes(int|float $value): self
    {
        return new static($value / 1024);
    }

    /**
     * @return int|float
     */
    public function toBytes(): int|float
    {
        return $this->value * 1024;
    }

    /**
     * @param int|float $value
     * @return static
     */
    public static function fromMegabytes(int|float $value): self
    {
        return new static($value * 1024);
    }

    /**
     * @return int|float
     */
    public function toMegabytes(): int|float
    {
        return $this->value / 1024;
    }

    /**
     * @param int|float $value
     * @return static
     */
    public static function fromGigabytes(int|float $value): self
    {
        return new static($value * 1024 * 1024);
    }

    /**
     * @return int|float
     */
    public function toGigabytes(): int|float
    {
        return $this->value / 1024 / 1024;
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
