<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfInformation;

final class Byte extends UnitOfInformation
{
    const NAME = 'Byte';
    const PLURAL = 'Bytes';
    const SYMBOL = 'B';

    /**
     * @param int|float $value
     * @return Byte
     */
    public static function fromKilobytes(int|float $value): Byte
    {
        return new Byte($value * 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Byte
     */
    public static function innFromKilobytes(int|float|null $value): ?Byte
    {
        if (is_null($value)) return null;
        return new Byte($value * 1024);
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
     * @return Byte
     */
    public static function fromMegabytes(int|float $value): Byte
    {
        return new Byte($value * 1024 * 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Byte
     */
    public static function innFromMegabytes(int|float|null $value): ?Byte
    {
        if (is_null($value)) return null;
        return new Byte($value * 1024 * 1024);
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
     * @return Byte
     */
    public static function fromGigabytes(int|float $value): Byte
    {
        return new Byte($value * 1024 * 1024 * 1024);
    }

    /**
     * @param int|float|null $value
     * @return ?Byte
     */
    public static function innFromGigabytes(int|float|null $value): ?Byte
    {
        if (is_null($value)) return null;
        return new Byte($value * 1024 * 1024 * 1024);
    }

    /**
     * @return int|float
     */
    public function toGigabytes(): int|float
    {
        return $this->value / 1024 / 1024 / 1024;
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
