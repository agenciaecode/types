<?php declare(strict_types=1);

namespace Ecode\Types\Address;

use Ecode\Enums\Country;
use Ecode\Types\Address\PostalCode\PostalCode;

class Br implements AddressStandard
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
    public function isValid(
        string $addressLine1,
        ?string $addressLine2 = null,
        ?string $dependentLocality = null,
        ?string $locality = null,
        ?string $adminArea = null,
        ?string $postalCode = null,
        ?string $poBox = null
    ): bool
    {
        if (!PostalCode::isValid($postalCode, Country::BRAZIL)) return false;
        if (is_null($dependentLocality)) return false;
        if (is_null($locality)) return false;
        if (is_null($adminArea)) return false;
        if (is_null($postalCode)) return false;
        return true;
    }
}