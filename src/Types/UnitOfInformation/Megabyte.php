<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfInformation;

final class Megabyte extends UnitOfInformation
{
    const NAME = 'Megabyte';
    const PLURAL = 'Megabytes';
    const SYMBOL = 'MB';

    /**
     * @param int|float $value
     * @return Megabyte
     */
    public static function fromBytes(int|float $value): Megabyte
    {
        return new Megabyte($value / 1024 / 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Megabyte
     */
    public static function innFromBytes(int|float|null $value): ?Megabyte
    {
        if (is_null($value)) return null;
        return new Megabyte($value / 1024 / 1024);
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
     * @return Megabyte
     */
    public static function fromKilobytes(int|float $value): Megabyte
    {
        return new Megabyte($value / 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Megabyte
     */
    public static function innFromKilobytes(int|float|null $value): ?Megabyte
    {
        if (is_null($value)) return null;
        return new Megabyte($value / 1024);
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
     * @return Megabyte
     */
    public static function fromGigabytes(int|float $value): Megabyte
    {
        return new Megabyte($value * 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Megabyte
     */
    public static function innFromGigabytes(int|float|null $value): ?Megabyte
    {
        if (is_null($value)) return null;
        return new Megabyte($value * 1024);
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
