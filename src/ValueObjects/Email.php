<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;

class Email extends ValueObject
{
    /**
     * @param string $value
     * @throws InvalidValueHttpException
     */
    public function __construct(string $value)
    {
        if (!$this->isValid($value))
            throw new InvalidValueHttpException(sprintf('%s is an invalid E-mail.', $value));

        $this->value = strtolower($value);
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValid(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * @param string $maskCharacter
     * @return string
     */
    public function getHiddenFormat(string $maskCharacter = '*'): string
    {
        $emailExploded = explode('@', $this->value);
        $mailPart = array_shift($emailExploded);
        $domainPart = array_shift($emailExploded);

        return sprintf(
            '%s@%s',
            $this->mask($mailPart, $maskCharacter),
            $this->mask($domainPart, $maskCharacter)
        );
    }

    /**
     * @param string $value
     * @param string $maskCharacter
     * @return string
     */
    private function mask(string $value, string $maskCharacter): string
    {
        if (strlen($value) === 2) return sprintf(
            '%s%s',
            substr($value, 0, 1),
            $maskCharacter,
        );

        if (strlen($value) <= 10) return sprintf(
            '%s%s%s',
            substr($value, 0, 1),
            str_repeat($maskCharacter, strlen($value) - 2),
            substr($value, -1)
        );

        return sprintf(
            '%s%s%s',
            substr($value, 0, 2),
            str_repeat($maskCharacter, strlen($value) - 3),
            substr($value, -1)
        );
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
