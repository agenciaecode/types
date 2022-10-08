<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfInformation;

final class Kilobyte extends UnitOfInformation
{
    const NAME = 'Kilobyte';
    const PLURAL = 'Kilobytes';
    const SYMBOL = 'KB';

    /**
     * @param int|float $value
     * @return Kilobyte
     */
    public static function fromBytes(int|float $value): Kilobyte
    {
        return new Kilobyte($value / 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Kilobyte
     */
    public static function innFromBytes(int|float|null $value): ?Kilobyte
    {
        if (is_null($value)) return null;
        return new Kilobyte($value / 1024);
    }

    /**
     * @return Byte
     */
    public function toBytes(): Byte
    {
        return Byte::fromKilobytes($this->value);
    }

    /**
     * @param int|float $value
     * @return Kilobyte
     */
    public static function fromMegabytes(int|float $value): Kilobyte
    {
        return new Kilobyte($value * 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Kilobyte
     */
    public static function innFromMegabytes(int|float|null $value): ?Kilobyte
    {
        if (is_null($value)) return null;
        return new Kilobyte($value * 1024);
    }

    /**
     * @return Megabyte
     */
    public function toMegabytes(): Megabyte
    {
        return Megabyte::fromKilobytes($this->value);
    }

    /**
     * @param int|float $value
     * @return Kilobyte
     */
    public static function fromGigabytes(int|float $value): Kilobyte
    {
        return new Kilobyte($value * 1024 * 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Kilobyte
     */
    public static function innFromGigabytes(int|float|null $value): ?Kilobyte
    {
        if (is_null($value)) return null;
        return new Kilobyte($value * 1024 * 1024);
    }

    /**
     * @return Gigabyte
     */
    public function toGigabytes(): Gigabyte
    {
        return Gigabyte::fromKilobytes($this->value);
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
