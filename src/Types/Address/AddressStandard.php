<?php declare(strict_types=1);

namespace Ecode\Types\Address;

interface AddressStandard
{
    public static function validator(
        string $addressLine1,
        ?string $addressLine2 = null,
        ?string $dependentLocality = null,
        ?string $locality = null,
        ?string $adminArea = null,
        ?string $postalCode = null,
        ?string $poBox = null,
    ): ?array;
}
