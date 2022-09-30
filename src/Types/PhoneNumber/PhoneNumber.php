<?php declare(strict_types=1);

namespace Mkioschi\Types\PhoneNumber;

use Exception;
use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\PhoneNumber\Standards\Br;
use Mkioschi\Types\PhoneNumber\Standards\Generic;
use Mkioschi\Types\PhoneNumber\Standards\Us;
use Mkioschi\Types\Str;

/**
 * Phone Number
 *
 * The phone number must have the following format "<country-code> <area-code> <local-number>"
 * For example: 55 44 36243639
 *  - 55 is an International Country code;
 *  - 44 is an Area code;
 *  - and 36243639 is a Local number.
 */
final class PhoneNumber
{
    /**
     * @var PhoneNumberStandard
     */
    private PhoneNumberStandard $standardPhoneNumber;

    /**
     * @var string
     */
    private string $countryCode;

    /**
     * @var string
     */
    private string $areaCode;

    /**
     * @var string
     */
    private string $localNumber;

    /**
     * @param string $value
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        $valueExploded = explode(' ', $value);

        if (count($valueExploded) < 3)
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Phone Number.', $value));

        $this->countryCode = Str::extractNumbers(array_shift($valueExploded));
        $this->areaCode = Str::extractNumbers(array_shift($valueExploded));
        $this->localNumber = Str::extractNumbers(join($valueExploded));

        $this->standardPhoneNumber = $this->buildStandardPhoneNumber($this->countryCode);

        if (!$this->standardPhoneNumber->isValid($this->countryCode, $this->areaCode, $this->localNumber))
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Phone Number.', $value));
    }

    /**
     * @param string $countryCode
     * @return PhoneNumberStandard
     */
    private function buildStandardPhoneNumber(string $countryCode): PhoneNumberStandard
    {
        return match ($countryCode) {
            '1' => new Us,
            '55' => new Br,
            default => new Generic,
        };
    }

    /**
     * @param string $value
     * @return PhoneNumber
     * @throws InvalidTypeHttpException
     */
    public static function from(string $value): PhoneNumber
    {
        return new PhoneNumber($value);
    }

    /**
     * @param string $value
     * @return ?PhoneNumber
     */
    public static function tryFrom(string $value): ?PhoneNumber
    {
        try {
            return new PhoneNumber($value);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @param ?string $value
     * @return ?PhoneNumber
     * @throws InvalidTypeHttpException
     */
    public static function fromIfNotNull(?string $value): ?PhoneNumber
    {
        if (is_null($value)) return null;
        return new PhoneNumber($value);
    }

    /**
     * @return string
     */
    public function getWhatsAppFormat(): string
    {
        return sprintf(
            '%s%s%s',
            $this->countryCode,
            $this->areaCode,
            $this->localNumber
        );
    }

    /**
     * @return string
     */
    public function getHumansFormat(): string
    {
        return $this->standardPhoneNumber->makeHumansFormat(
            $this->countryCode,
            $this->areaCode,
            $this->localNumber
        );
    }

    /**
     * @return string
     */
    public function getE164Format(): string
    {
        return sprintf(
            '+%s%s%s',
            $this->countryCode,
            $this->areaCode,
            $this->localNumber
        );
    }

    /**
     * @param string $maskCharacter
     * @return string
     */
    public function getHiddenFormat(string $maskCharacter = '*'): string
    {
        return $this->standardPhoneNumber->makeHiddenFormat(
            $this->countryCode,
            $this->areaCode,
            $this->localNumber,
            $maskCharacter
        );
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return sprintf(
            '%s %s %s',
            $this->countryCode,
            $this->areaCode,
            $this->localNumber
        );
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
}
