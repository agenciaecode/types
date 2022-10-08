<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfInformation;

final class Gigabyte extends UnitOfInformation
{
    const NAME = 'Gigabyte';
    const PLURAL = 'Gigabytes';
    const SYMBOL = 'GB';

    /**
     * @param int|float $value
     * @return Gigabyte
     */
    public static function fromBytes(int|float $value): Gigabyte
    {
        return new Gigabyte($value / 1024 / 1024 / 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Gigabyte
     */
    public static function innFromBytes(int|float|null $value): ?Gigabyte
    {
        if (is_null($value)) return null;
        return new Gigabyte($value / 1024 / 1024 / 1024);
    }

    /**
     * @return Byte
     */
    public function toBytes(): Byte
    {
        return Byte::fromGigabytes($this->value);
    }

    /**
     * @param int|float $value
     * @return Gigabyte
     */
    public static function fromKilobytes(int|float $value): Gigabyte
    {
        return new Gigabyte($value / 1024 / 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Gigabyte
     */
    public static function innFromKilobytes(int|float|null $value): ?Gigabyte
    {
        if (is_null($value)) return null;
        return new Gigabyte($value / 1024 / 1024);
    }

    /**
     * @return Kilobyte
     */
    public function toKilobytes(): Kilobyte
    {
        return Kilobyte::fromGigabytes($this->value);
    }

    /**
     * @param int|float $value
     * @return Gigabyte
     */
    public static function fromMegabytes(int|float $value): Gigabyte
    {
        return new Gigabyte($value / 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Gigabyte
     */
    public static function innFromMegabytes(int|float|null $value): ?Gigabyte
    {
        if (is_null($value)) return null;
        return new Gigabyte($value / 1024);
    }

    /**
     * @return Megabyte
     */
    public function toMegabytes(): Megabyte
    {
        return Megabyte::fromGigabytes($this->value);
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
