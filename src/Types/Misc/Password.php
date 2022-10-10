<?php declare(strict_types=1);

namespace Ecode\Types\Misc;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Exception;

final class Password
{
    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $value
     * @param int $minChars
     * @param bool $uppercase
     * @param bool $lowercase
     * @param bool $number
     * @param bool $symbol
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
        if (!self::isValid($value, $minChars, $uppercase, $lowercase, $number, $symbol))
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Password type.', $value));
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @param int $minChars
     * @param bool $uppercase
     * @param bool $lowercase
     * @param bool $number
     * @param bool $symbol
     * @return bool
     */
    public static function isValid(
        mixed $value,
        int $minChars,
        bool $uppercase,
        bool $lowercase,
        bool $number,
        bool $symbol
    ): bool
    {
        if (!is_string($value)) return false;
        if (strlen($value) < $minChars) return false;
        if ($uppercase && preg_match('@[A-Z]@', $value) === 0) return false;
        if ($lowercase && preg_match('@[a-z]@', $value) === 0) return false;
        if ($number && preg_match('@[0-9]@', $value) === 0) return false;
        if ($symbol &&preg_match('@\W@', $value) === 0) return false;
        return true;
    }

    /**
     * @param string $value
     * @param int $minChars
     * @param bool $uppercase
     * @param bool $lowercase
     * @param bool $number
     * @param bool $symbol
     * @return Password
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

    /**
     * @param string $value
     * @param int $minChars
     * @param bool $uppercase
     * @param bool $lowercase
     * @param bool $number
     * @param bool $symbol
     * @return ?Password
     */
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
     * @param ?string $value
     * @param int $minChars
     * @param bool $uppercase
     * @param bool $lowercase
     * @param bool $number
     * @param bool $symbol
     * @return ?Password
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
        if (is_null($value)) return null;
        return new Password($value, $minChars, $uppercase, $lowercase, $number, $symbol);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param self $value
     * @return bool
     */
    public function equals(Password $value): bool
    {
        return $this->getValue() === $value->getValue();
    }
}
