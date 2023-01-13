<?php declare(strict_types=1);

namespace Ecode\Types\Address;

interface AddressStandard
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
        ?string $poBox = null,
    ): bool;

    /**
     * @param string $addressLine1
     * @return bool
     */
    public static function isAddressLine1Valid(string $addressLine1): bool;

    /**
     * @param ?string $addressLine2
     * @return bool
     */
    public static function isAddressLine2Valid(?string $addressLine2): bool;

    /**
     * @param ?string $dependentLocality
     * @return bool
     */
    public static function isDependentLocalityValid(?string $dependentLocality): bool;

    /**
     * @param ?string $locality
     * @return bool
     */
    public static function isLocalityValid(?string $locality): bool;

    /**
     * @param ?string $adminArea
     * @return bool
     */
    public static function isAdminAreaValid(?string $adminArea): bool;

    /**
     * @param ?string $postalCode
     * @return bool
     */
    public static function isPostalCodeValid(?string $postalCode): bool;

    /**
     * @param ?string $poBox
     * @return bool
     */
    public static function isPoBoxValid(?string $poBox): bool;
}
