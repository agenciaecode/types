<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\UnitOfInformation;

class Byte extends UnitOfInformation
{
    const NAME = 'Byte';
    const PLURAL = 'Bytes';
    const SYMBOL = 'B';

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
    public static function fromKilobytes(int|float $value): self
    {
        return new static($value * 1024);
    }

    /**
     * @return int|float
     */
    public function toKilobytes(): int|float
    {
        return $this->value / 1024;
    }

    /**
     * @param int|float $value
     * @return static
     */
    public static function fromMegabytes(int|float $value): self
    {
        return new static($value * 1024 * 1024);
    }

    /**
     * @return int|float
     */
    public function toMegabytes(): int|float
    {
        return $this->value / 1024 / 1024;
    }

    /**
     * @param int|float $value
     * @return static
     */
    public static function fromGigabytes(int|float $value): self
    {
        return new static($value * 1024 * 1024 * 1024);
    }

    /**
     * @return int|float
     */
    public function toGigabytes(): int|float
    {
        return $this->value / 1024 / 1024 / 1024;
    }
}
