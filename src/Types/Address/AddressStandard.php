<?php declare(strict_types=1);

namespace Ecode\Types\Address;

interface AddressStandard
{
    public static function isValid(
        string $addressLine1,
        ?string $addressLine2 = null,
        ?string $dependentLocality = null,
        ?string $locality = null,
        ?string $adminArea = null,
        ?string $postalCode = null,
        ?string $poBox = null,
    ): bool;

    public static function isAddressLine1Valid(string $addressLine1): bool;

    public static function isAddressLine2Valid(?string $addressLine2): bool;

    public static function isDependentLocalityValid(?string $dependentLocality): bool;

    public static function isLocalityValid(?string $locality): bool;

    public static function isAdminAreaValid(?string $adminArea): bool;

    public static function isPostalCodeValid(?string $postalCode): bool;

    public static function isPoBoxValid(?string $poBox): bool;
}
