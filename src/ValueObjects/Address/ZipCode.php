<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\Address;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\ValueObject;

class ZipCode extends ValueObject
{
    /**
     * @param string $value
     * @throws InvalidValueHttpException
     */
    public function __construct(string $value)
    {
        if (!$this->isValid($value))
            throw new InvalidValueHttpException(sprintf('%s is an invalid Zip Code.', $value));

        $this->value = self::cleanOnlyNumbers($value);
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValid(string $value): bool
    {
        $zipCode = self::cleanOnlyNumbers($value);
        if (strlen($zipCode) != 8) return false;
        return is_numeric($zipCode);
    }

    /**
     * @return string
     */
    public function getHumansFormat(): string
    {
        return sprintf(
            '%s-%s',
            substr($this->value, 0, 5),
            substr($this->value, -3)
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
