<?php declare(strict_types=1);

namespace Ecode\Types\Address;

use Ecode\Enums\Country;
use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\ErrorsTrait;

final class Address
{
    use ErrorsTrait;

    /** @var Country */
    protected Country $country;

    /** @var string */
    protected string $addressLine1;

    /** @var ?string */
    protected ?string $addressLine2;

    /** @var ?string */
    protected ?string $dependentLocality;

    /** @var ?string */
    protected ?string $locality;

    /** @var ?string */
    protected ?string $adminArea;

    /** @var ?string */
    protected ?string $postalCode;

    /** @var ?string */
    protected ?string $poBox;

    /** @var AddressStandard  */
    protected AddressStandard $addressStandard;

    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(
        Country $country,
        string $addressLine1,
        ?string $addressLine2 = null,
        ?string $dependentLocality = null,
        ?string $locality = null,
        ?string $adminArea = null,
        ?string $postalCode = null,
        ?string $poBox = null,
    )
    {
        $this->addressStandard = self::buildStandardByCountry($country);

        if (!$this->addressStandard->isAddressLine1Valid($addressLine1))
            $this->addError('Invalid address line 1.');

        if (!$this->addressStandard->isAddressLine2Valid($addressLine2))
            $this->addError('Invalid address line 2.');

        if (!$this->addressStandard->isDependentLocalityValid($dependentLocality))
            $this->addError('Invalid dependent locality.');

        if (!$this->addressStandard->isLocalityValid($locality))
            $this->addError('Invalid locality.');

        if (!$this->addressStandard->isAdminAreaValid($adminArea))
            $this->addError('Invalid admin area.');

        if (!$this->addressStandard->isPostalCodeValid($postalCode))
            $this->addError('Invalid postal code.');

        if (!$this->addressStandard->isPoBoxValid($poBox))
            $this->addError('Invalid P.O. Box.');

        if ($this->hasErrors())
            throw new InvalidTypeHttpException(
                message: sprintf('Invalid %s type.', self::class),
                errors: $this->getErrors()
            );

        $this->country = $country;
        $this->addressLine1 = $addressLine1;
        $this->addressLine2 = $addressLine2;
        $this->dependentLocality = $dependentLocality;
        $this->locality = $locality;
        $this->adminArea = $adminArea;
        $this->postalCode = $postalCode;
        $this->poBox = $poBox;
    }

    /**
     * @param Country $country
     * @param string $addressLine1
     * @param ?string $addressLine2
     * @param ?string $dependentLocality
     * @param ?string $locality
     * @param ?string $adminArea
     * @param ?string $postalCode
     * @param ?string $poBox
     * @return bool
     */
    public static function isValid(
        Country $country,
        string $addressLine1,
        ?string $addressLine2 = null,
        ?string $dependentLocality = null,
        ?string $locality = null,
        ?string $adminArea = null,
        ?string $postalCode = null,
        ?string $poBox = null,
    ): bool
    {
        $addressStandard = self::buildStandardByCountry($country);
        return $addressStandard->isValid(
            $addressLine1,
            $addressLine2,
            $dependentLocality,
            $locality,
            $adminArea,
            $postalCode,
            $poBox
        );
    }

    /**
     * @param Country $country
     * @return AddressStandard
     */
    private static function buildStandardByCountry(Country $country): AddressStandard
    {
        return match ($country) {
            Country::BRAZIL => new Br,
            default => new Generic,
        };
    }

    /**
     * @param Country $country
     * @param string $addressLine1
     * @param ?string $addressLine2
     * @param ?string $dependentLocality
     * @param ?string $locality
     * @param ?string $adminArea
     * @param ?string $postalCode
     * @param ?string $poBox
     * @return Address
     * @throws InvalidTypeHttpException
     */
    public static function from(
        Country $country,
        string $addressLine1,
        ?string $addressLine2 = null,
        ?string $dependentLocality = null,
        ?string $locality = null,
        ?string $adminArea = null,
        ?string $postalCode = null,
        ?string $poBox = null,
    ): Address
    {
        return new Address(
            $country,
            $addressLine1,
            $addressLine2,
            $dependentLocality,
            $locality,
            $adminArea,
            $postalCode,
            $poBox
        );
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->addressLine1;
    }

    /**
     * @return ?string
     */
    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    /**
     * @return ?string
     */
    public function getDependentLocality(): ?string
    {
        return $this->dependentLocality;
    }

    /**
     * @return ?string
     */
    public function getLocality(): ?string
    {
        return $this->locality;
    }

    /**
     * @return ?string
     */
    public function getAdminArea(): ?string
    {
        return $this->adminArea;
    }

    /**
     * @return ?string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @return ?string
     */
    public function getPoBox(): ?string
    {
        return $this->poBox;
    }
}
