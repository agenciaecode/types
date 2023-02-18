<?php declare(strict_types=1);

namespace Ecode\Types\Address\PostalCode;

use Ecode\Enums\Country;
use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Exception;

final class PostalCode
{
    /** @var string */
    public readonly string $value;

    /** @var Country  */
    public readonly Country $country;

    /** @var PostalCodeStandard */
    private PostalCodeStandard $postalCodeStandard;

    /**
     * @param string $value
     * @param Country $country
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value, Country $country)
    {
        $this->postalCodeStandard = self::buildStandardByCountry($country);
        if (!$this->postalCodeStandard->isValid($value))
            throw new InvalidTypeHttpException(sprintf('%s is an invalid PostalCode type.', $value));
        $this->value = $value;
        $this->country = $country;
    }

    /**
     * @param mixed $value
     * @param Country $country
     * @return bool
     */
    public static function isValid(mixed $value, Country $country): bool
    {
        $postalCodeStandard = self::buildStandardByCountry($country);
        return $postalCodeStandard->isValid($value);
    }

    /**
     * @param Country $country
     * @return PostalCodeStandard
     */
    private static function buildStandardByCountry(Country $country): PostalCodeStandard
    {
        return match ($country) {
            Country::BRAZIL => new Br,
            default => new Generic,
        };
    }

    /**
     * @param string $value
     * @param Country $country
     * @return PostalCode
     * @throws InvalidTypeHttpException
     */
    public static function from(string $value, Country $country): PostalCode
    {
        return new PostalCode($value, $country);
    }

    /**
     * @param string $value
     * @param Country $country
     * @return ?PostalCode
     */
    public static function tryFrom(string $value, Country $country): ?PostalCode
    {
        try {
            return new PostalCode($value, $country);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @param ?string $value
     * @param ?Country $country
     * @return ?PostalCode
     * @throws InvalidTypeHttpException
     */
    public static function innFrom(?string $value, ?Country $country): ?PostalCode
    {
        if (is_null($value) || is_null($country)) return null;
        return new PostalCode($value, $country);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
