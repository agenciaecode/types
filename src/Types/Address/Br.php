<?php declare(strict_types=1);

namespace Ecode\Types\Address;

use Ecode\Enums\Country;
use Ecode\Types\Address\PostalCode\PostalCode;

class Br implements AddressStandard
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
        if (!self::isAddressLine1Valid($addressLine1)) {
            return false;
        }

        if (!self::isAddressLine2Valid($addressLine2)) {
            return false;
        }

        if (!self::isDependentLocalityValid($dependentLocality)) {
            return false;
        }

        if (!self::isLocalityValid($locality)) {
            return false;
        }

        if (!self::isAdminAreaValid($adminArea)) {
            return false;
        }

        if (!self::isPostalCodeValid($postalCode)) {
            return false;
        }

        if (!self::isPoBoxValid($poBox)) {
            return false;
        }

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
        return $dependentLocality !== null;
    }

    public static function isLocalityValid(?string $locality): bool
    {
        return $locality !== null;
    }

    public static function isAdminAreaValid(?string $adminArea): bool
    {
        return $adminArea !== null;
    }

    public static function isPostalCodeValid(?string $postalCode): bool
    {
        return PostalCode::isValid($postalCode, Country::BRAZIL) === true;
    }

    public static function isPoBoxValid(?string $poBox): bool
    {
        return true;
    }
}