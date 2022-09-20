<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects;

interface ValueObjectContract
{
    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool;

    /**
     * @param mixed $value
     * @return static
     */
    public static function from(mixed $value): static;

    /**
     * @param mixed $value
     * @return ?static
     */
    public static function tryFrom(mixed $value): ?static;

    /**
     * @param mixed $value
     * @return ?static
     */
    public static function fromIfNotNull(mixed $value): ?static;

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * @param ValueObjectContract $value
     * @return bool
     */
    public function equals(ValueObjectContract $value): bool;
}
