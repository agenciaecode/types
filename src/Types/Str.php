<?php declare(strict_types=1);

namespace Ecode\Types;

use Cocur\Slugify\Slugify;
use Exception;

class Str
{
    /**
     * @var string
     */
    protected string $value;

    /**
     * @param string $value
     */
    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        return is_string($value);
    }

    /**
     * @param string $value
     * @return static
     */
    public static function from(string $value): static
    {
        return new static($value);
    }

    /**
     * @param string $value
     * @return ?static
     */
    public static function tryFrom(string $value): ?static
    {
        try {
            return new static($value);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @param ?string $value
     * @return ?static
     */
    public static function innFrom(?string $value): ?static
    {
        if (is_null($value)) return null;
        return new static($value);
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
    public function equals(self $value): bool
    {
        return $this->getValue() === $value->getValue();
    }

    /**
     * @param string $value
     * @return string
     */
    public static function extractNumbers(string $value): string
    {
        return preg_replace(pattern: '/\D/i', replacement: '', subject: trim($value));
    }

    /**
     * @param string $text
     * @return string
     */
    public static function slugify(string $text): string
    {
        $slugify = new Slugify();
        return $slugify->slugify($text);
    }
}
