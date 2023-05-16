<?php declare(strict_types=1);

namespace Ecode\Types\Misc;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\Str;

final class Slug extends Str
{
    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Slug type.', $value));
        }

        parent::__construct($value);
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        if (strlen($value) < 1) {
            return false;
        }

        return !preg_match("/[^0-9a-z-]/", $value);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function fromText(string $text): Slug
    {
        return new Slug(self::slugify($text));
    }
}
