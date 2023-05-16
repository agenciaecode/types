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

    public readonly Country $country;
    public readonly string $addressLine1;
    public readonly ?string $addressLine2;
    public readonly ?string $dependentLocality;
    public readonly ?string $locality;
    public readonly ?string $adminArea;
    public readonly ?string $postalCode;
    public readonly ?string $poBox;
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

        if (!$this->addressStandard->isAddressLine1Valid($addressLine1)) {
            $this->addError('Invalid address line 1.');
        }

        if (!$this->addressStandard->isAddressLine2Valid($addressLine2)) {
            $this->addError('Invalid address line 2.');
        }

        if (!$this->addressStandard->isDependentLocalityValid($dependentLocality)) {
            $this->addError('Invalid dependent locality.');
        }

        if (!$this->addressStandard->isLocalityValid($locality)) {
            $this->addError('Invalid locality.');
        }

        if (!$this->addressStandard->isAdminAreaValid($adminArea)) {
            $this->addError('Invalid admin area.');
        }

        if (!$this->addressStandard->isPostalCodeValid($postalCode)) {
            $this->addError('Invalid postal code.');
        }

        if (!$this->addressStandard->isPoBoxValid($poBox)) {
            $this->addError('Invalid P.O. Box.');
        }

        if ($this->hasErrors()) {
            throw new InvalidTypeHttpException(
                message: sprintf('Invalid %s type.', self::class),
                errors: $this->getErrors()
            );
        }

        $this->country = $country;
        $this->addressLine1 = $addressLine1;
        $this->addressLine2 = $addressLine2;
        $this->dependentLocality = $dependentLocality;
        $this->locality = $locality;
        $this->adminArea = $adminArea;
        $this->postalCode = $postalCode;
        $this->poBox = $poBox;
    }

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

    private static function buildStandardByCountry(Country $country): AddressStandard
    {
        return match ($country) {
            Country::BRAZIL => new Br,
            default => new Generic,
        };
    }

    /**
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
