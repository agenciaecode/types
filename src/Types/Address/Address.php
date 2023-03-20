<?php declare(strict_types=1);

namespace Ecode\Types\Address;

use Ecode\Enums\Country;
use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\ErrorsTrait;

/**
 * Fields of Address class:
 * - country: "<Country>"
 * - address_line_1: "<Street Type> <Street Name>, <House Number>"
 * - address_line_2: "<Building/Floor/Apartment>"
 * - dependent_locality: "<Dependent Locality/District>"
 * - locality: "<Locality/City/Town>"
 * - admin_area: "<State/Province/Region>"
 * - postal_code: "<Postal/Zip Code>"
 * - po_box: "<P.O. Box>"
 */
final class Address
{
    use ErrorsTrait;

    /** @var Country */
    public readonly Country $country;

    /** @var string */
    public readonly string $addressLine1;

    /** @var ?string */
    public readonly ?string $addressLine2;

    /** @var ?string */
    public readonly ?string $dependentLocality;

    /** @var ?string */
    public readonly ?string $locality;

    /** @var ?string */
    public readonly ?string $adminArea;

    /** @var ?string */
    public readonly ?string $postalCode;

    /** @var ?string */
    public readonly ?string $poBox;

    /** @var AddressStandard  */
    public readonly AddressStandard $addressStandard;

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
     * @param array $addressArray
     * @return Address
     * @throws InvalidTypeHttpException
     */
    public static function fromArray(array $addressArray): Address
    {
        return new Address(
            Country::from($addressArray['country']),
            $addressArray['address_line_1'],
            $addressArray['address_line_2'],
            $addressArray['dependent_locality'],
            $addressArray['locality'],
            $addressArray['admin_area'],
            $addressArray['postal_code'],
            $addressArray['po_box']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'country' => $this->country->value,
            'address_line_1' => $this->addressLine1,
            'address_line_2' => $this->addressLine2,
            'dependent_locality' => $this->dependentLocality,
            'locality' => $this->locality,
            'admin_area' => $this->adminArea,
            'postal_code' => $this->postalCode,
            'po_box' => $this->poBox,
        ];
    }
}
