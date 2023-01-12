<?php declare(strict_types=1);

namespace Ecode\Tests\Types\Address;

use Ecode\Enums\Country;
use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\Address\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_address()
    {
        $address = Address::from(
            country: Country::BRAZIL,
            addressLine1: 'Rua Ministro Oliveira Salazar, 5159',
            addressLine2: 'Sala 01',
            dependentLocality: 'Centro',
            locality: 'Umuarama',
            adminArea: 'Paraná',
            postalCode: '87502-070'
        );
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('Rua Ministro Oliveira Salazar, 5159', $address->getAddressLine1());
        $this->assertEquals('Sala 01', $address->getAddressLine2());
        $this->assertEquals('Centro', $address->getDependentLocality());
        $this->assertEquals('Umuarama', $address->getLocality());
        $this->assertEquals('Paraná', $address->getAdminArea());
        $this->assertEquals('87502-070', $address->getPostalCode());
    }
}