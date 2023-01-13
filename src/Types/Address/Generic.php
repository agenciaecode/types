<?php declare(strict_types=1);

namespace Ecode\Types\Address;

class Generic implements AddressStandard
{
    /**
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
        string $addressLine1,
        ?string $addressLine2 = null,
        ?string $dependentLocality = null,
        ?string $locality = null,
        ?string $adminArea = null,
        ?string $postalCode = null,
        ?string $poBox = null
    ): bool
    {
        return true;
    }

    /**
     * @param string $addressLine1
     * @return bool
     */
    public static function isAddressLine1Valid(string $addressLine1): bool
    {
        return true;
    }

    /**
     * @param ?string $addressLine2
     * @return bool
     */
    public static function isAddressLine2Valid(?string $addressLine2): bool
    {
        return true;
    }

    /**
     * @param ?string $dependentLocality
     * @return bool
     */
    public static function isDependentLocalityValid(?string $dependentLocality): bool
    {
        return true;
    }

    /**
     * @param ?string $locality
     * @return bool
     */
    public static function isLocalityValid(?string $locality): bool
    {
        return true;
    }

    /**
     * @param ?string $adminArea
     * @return bool
     */
    public static function isAdminAreaValid(?string $adminArea): bool
    {
        return true;
    }

    /**
     * @param ?string $postalCode
     * @return bool
     */
    public static function isPostalCodeValid(?string $postalCode): bool
    {
        return true;
    }

    /**
     * @param ?string $poBox
     * @return bool
     */
    public static function isPoBoxValid(?string $poBox): bool
    {
        return true;
    }
}