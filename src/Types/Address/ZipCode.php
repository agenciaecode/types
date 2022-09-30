<?php declare(strict_types=1);

namespace Mkioschi\Types\Address;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Str;

final class ZipCode extends Str
{
    /**
     * @param string $value
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!$this->isValid($value))
            throw new InvalidTypeHttpException(sprintf('%s is an invalid ZipCode type.', $value));
        parent::__construct(Str::extractNumbers($value));
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) return false;
        $zipCode = Str::extractNumbers($value);
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
}
