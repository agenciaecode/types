<?php declare(strict_types=1);

namespace Ecode\Types\Web;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\Str;

final class Ip extends Str
{
    /**
     * @param string $value
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Ip type.', $value));
        }

        parent::__construct(strtolower($value));
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_IP, [FILTER_FLAG_IPV4, FILTER_FLAG_IPV6]) !== false;
    }

    public function isV4(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    public function isV6(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}
