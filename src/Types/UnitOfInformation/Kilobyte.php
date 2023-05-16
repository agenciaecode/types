<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfInformation;

final class Kilobyte extends UnitOfInformation
{
    const NAME = 'Kilobyte';
    const PLURAL = 'Kilobytes';
    const SYMBOL = 'KB';

    public static function fromBytes(int|float $value): Kilobyte
    {
        return new Kilobyte($value / 1024);
    }

    public static function innFromBytes(int|float|null $value): ?Kilobyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilobyte($value / 1024);
    }

    public function toBytes(): Byte
    {
        return Byte::fromKilobytes($this->value);
    }

    public static function fromMegabytes(int|float $value): Kilobyte
    {
        return new Kilobyte($value * 1024);
    }

    public static function innFromMegabytes(int|float|null $value): ?Kilobyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilobyte($value * 1024);
    }

    public function toMegabytes(): Megabyte
    {
        return Megabyte::fromKilobytes($this->value);
    }

    public static function fromGigabytes(int|float $value): Kilobyte
    {
        return new Kilobyte($value * 1024 * 1024);
    }

    public static function innFromGigabytes(int|float|null $value): ?Kilobyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilobyte($value * 1024 * 1024);
    }

    public function toGigabytes(): Gigabyte
    {
        return Gigabyte::fromKilobytes($this->value);
    }

    public static function getSymbol(): string
    {
        return self::SYMBOL;
    }

    public static function getName(): string
    {
        return self::NAME;
    }

    public static function getPlural(): string
    {
        return self::PLURAL;
    }
}
