<?php declare(strict_types=1);

namespace Ecode\Types\Misc;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\Str;

final class Slug extends Str
{
    /**
     * @param string $value
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value))
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Slug type.', $value));
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) return false;
        if (strlen($value) < 1) return false;
        return !preg_match("/[^0-9a-z-]/", $value);
    }

    /**
     * @param string $text
     * @return Slug
     * @throws InvalidTypeHttpException
     */
    public static function fromText(string $text): Slug
    {
        return new Slug(self::slugify($text));
    }
}
