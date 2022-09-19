<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\PhoneNumber;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\PhoneNumber\Standards\Br;
use Mkioschi\ValueObjects\PhoneNumber\Standards\Generic;
use Mkioschi\ValueObjects\PhoneNumber\Standards\Us;
use Mkioschi\ValueObjects\ValueObject;

class PhoneNumber extends ValueObject
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
     * Phone Number
     *
     * The phone number must have the following format "<country-code> <area-code> <local-number>"
     * For example: 55 44 36243639
     *  - 55 is an International Country code;
     *  - 44 is an Area code;
     *  - and 36243639 is a Local number.
     *
     * @param string $value
     * @throws InvalidValueHttpException
     */
    public function __construct(string $value)
    {
        $valueExploded = explode(' ', $value);

        if (count($valueExploded) < 3)
            throw new InvalidValueHttpException(sprintf('%s is an invalid Phone Number.', $value));

        $this->countryCode = self::getOnlyNumbers(array_shift($valueExploded));
        $this->areaCode = self::getOnlyNumbers(array_shift($valueExploded));
        $this->localNumber = self::getOnlyNumbers(join($valueExploded));

        $this->standardPhoneNumber = $this->buildStandardPhoneNumber($this->countryCode);

        if (!$this->standardPhoneNumber->isValid($this->countryCode, $this->areaCode, $this->localNumber))
            throw new InvalidValueHttpException(sprintf('%s is an invalid Phone Number.', $value));
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
