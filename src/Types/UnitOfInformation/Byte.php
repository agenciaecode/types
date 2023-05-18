<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfInformation;

final class Byte extends UnitOfInformation
{
    const NAME = 'Byte';
    const PLURAL = 'Bytes';
    const SYMBOL = 'B';

    public static function fromKilobytes(int|float $value): Byte
    {
        return new Byte($value * 1024);
    }

    public static function innFromKilobytes(int|float|null $value): ?Byte
    {
        if (is_null($value)) {
            return null;
        }

        return new Byte($value * 1024);
    }

    public function toKilobytes(): Kilobyte
    {
        return Kilobyte::fromBytes($this->value);
    }

    public static function fromMegabytes(int|float $value): Byte
    {
        return new Byte($value * 1024 * 1024);
    }

    public static function innFromMegabytes(int|float|null $value): ?Byte
    {
        if (is_null($value)) {
            return null;
        }

        return new Byte($value * 1024 * 1024);
    }

    public function toMegabytes(): Megabyte
    {
        return Megabyte::fromBytes($this->value);
    }

    public static function fromGigabytes(int|float $value): Byte
    {
        return new Byte($value * 1024 * 1024 * 1024);
    }

    public static function innFromGigabytes(int|float|null $value): ?Byte
    {
        if (is_null($value)) {
            return null;
        }

        return new Byte($value * 1024 * 1024 * 1024);
    }

    public function toGigabytes(): Gigabyte
    {
        return Gigabyte::fromBytes($this->value);
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
