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
            dependentLocality: 'Zona 3',
            locality: 'Umuarama',
            adminArea: 'Paraná',
            postalCode: '87502-070',
            poBox: '12'
        );
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('Rua Ministro Oliveira Salazar, 5159', $address->addressLine1);
        $this->assertEquals(Country::BRAZIL, $address->country);
        $this->assertEquals('12', $address->poBox);
        $this->assertEquals('Sala 01', $address->addressLine2);
        $this->assertEquals('Zona 3', $address->dependentLocality);
        $this->assertEquals('Umuarama', $address->locality);
        $this->assertEquals('Paraná', $address->adminArea);
        $this->assertEquals('87502-070', $address->postalCode);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_address_from_array()
    {
        $addressArray = [
            'country' => 'BR',
            'address_line_1' => 'Rua Ministro Oliveira Salazar, 5159',
            'address_line_2' => 'Sala 01',
            'dependent_locality' => 'Zona 3',
            'locality' => 'Umuarama',
            'admin_area' => 'Paraná',
            'postal_code' => '87502-070',
            'po_box' =>  null,
        ];

        $address = Address::fromArray($addressArray);
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals($addressArray, $address->toArray());
    }
}