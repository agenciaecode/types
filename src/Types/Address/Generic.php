<?php declare(strict_types=1);

namespace Ecode\Types\Address;

class Generic implements AddressStandard
{
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

    public static function isAddressLine1Valid(string $addressLine1): bool
    {
        return true;
    }

    public static function isAddressLine2Valid(?string $addressLine2): bool
    {
        return true;
    }

    public static function isDependentLocalityValid(?string $dependentLocality): bool
    {
        return true;
    }

    public static function isLocalityValid(?string $locality): bool
    {
        return true;
    }

    public static function isAdminAreaValid(?string $adminArea): bool
    {
        return true;
    }

    public static function isPostalCodeValid(?string $postalCode): bool
    {
        return true;
    }

    public static function isPoBoxValid(?string $poBox): bool
    {
        return true;
    }
}