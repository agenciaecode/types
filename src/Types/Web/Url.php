<?php declare(strict_types=1);

namespace Ecode\Types\Web;

use Ecode\Enums\UriScheme;
use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\Str;

final class Url extends Str
{
    /**
     * @param string $value
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value))
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Url type.', $value));
        parent::__construct(strtolower($value));
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) return false;
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return parse_url($this->value, PHP_URL_SCHEME);
    }

    /**
     * @return ?string
     */
    public function getUser(): ?string
    {
        return parse_url($this->value, PHP_URL_USER);
    }

    /**
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return parse_url($this->value, PHP_URL_PASS);
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return parse_url($this->value, PHP_URL_HOST);
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return parse_url($this->value, PHP_URL_PORT) ?? 80;
    }

    /**
     * @return ?string
     */
    public function getPath(): ?string
    {
        return parse_url($this->value, PHP_URL_PATH);
    }

    /**
     * @return ?string
     */
    public function getQuery(): ?string
    {
        return parse_url($this->value, PHP_URL_QUERY);
    }

    /**
     * @return ?array
     */
    public function getQueryAsArray(): ?array
    {
        $query = parse_url($this->value, PHP_URL_QUERY);
        if (is_null($query)) return null;
        parse_str($query, $result);
        return $result;
    }

    /**
     * @return ?string
     */
    public function getFragment(): ?string
    {
        return parse_url($this->value, PHP_URL_FRAGMENT);
    }

    /**
     * @return bool
     */
    public function isSecure(): bool
    {
        return strtolower(parse_url($this->value, PHP_URL_SCHEME)) === UriScheme::HTTPS->value;
    }
}
