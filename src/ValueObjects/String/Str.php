<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\String;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\ValueObject;

class Str extends ValueObject
{
    /**
     * @param string $value
     * @param ?int $maxLength
     * @param bool $allowEmpty
     * @throws InvalidValueHttpException
     */
    public function __construct(string $value, ?int $maxLength = null, bool $allowEmpty = true)
    {
        if (!$this->isValid($value, $maxLength, $allowEmpty))
            throw new InvalidValueHttpException(sprintf('%s is an invalid String.', $value));

        $this->value = $value;
    }

    /**
     * @param string $value
     * @param ?int $maxLength
     * @param bool $allowEmpty
     * @return bool
     */
    public static function isValid(string $value, ?int $maxLength, bool $allowEmpty): bool
    {
        if (!$allowEmpty && empty($value)) return false;
        if ($maxLength && strlen($value) > $maxLength) return false;
        return true;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
