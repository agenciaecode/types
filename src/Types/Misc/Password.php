<?php declare(strict_types=1);

namespace Ecode\Types\Misc;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Exception;

/**
 * By default, the password must meet the following conditions:
 * - Must be at least 6 characters in length;
 * - Must include at least one upper case letter;
 * - Must include at least one lower case letter;
 * - Must include at least one number.
 */
final class Password
{
    public readonly string $value;

    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(
        string $value,
        int $minChars,
        bool $uppercase,
        bool $lowercase,
        bool $number,
        bool $symbol
    )
    {
        if (!self::isValid($value, $minChars, $uppercase, $lowercase, $number, $symbol)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Password type.', $value));
        }

        $this->value = $value;
    }

    public static function isValid(
        mixed $value,
        int $minChars,
        bool $uppercase,
        bool $lowercase,
        bool $number,
        bool $symbol
    ): bool
    {
        if (!is_string($value)) {
            return false;
        }

        if (strlen($value) < $minChars) {
            return false;
        }

        if ($uppercase && preg_match('@[A-Z]@', $value) === 0) {
            return false;
        }

        if ($lowercase && preg_match('@[a-z]@', $value) === 0) {
            return false;
        }

        if ($number && preg_match('@[0-9]@', $value) === 0) {
            return false;
        }

        if ($symbol &&preg_match('@\W@', $value) === 0) {
            return false;
        }

        return true;
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function from(
        string $value,
        int $minChars = 6,
        bool $uppercase = true,
        bool $lowercase = true,
        bool $number = true,
        bool $symbol = false
    ): Password
    {
        return new Password($value, $minChars, $uppercase, $lowercase, $number, $symbol);
    }

    public static function tryFrom(
        string $value,
        int $minChars = 6,
        bool $uppercase = true,
        bool $lowercase = true,
        bool $number = true,
        bool $symbol = false
    ): ?Password
    {
        try {
            return new Password($value, $minChars, $uppercase, $lowercase, $number, $symbol);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function innFrom(
        ?string $value,
        int $minChars = 6,
        bool $uppercase = true,
        bool $lowercase = true,
        bool $number = true,
        bool $symbol = false
    ): ?Password
    {
        if (is_null($value)) {
            return null;
        }

        return new Password($value, $minChars, $uppercase, $lowercase, $number, $symbol);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(Password $value): bool
    {
        return $this->value === $value->value;
    }
}
