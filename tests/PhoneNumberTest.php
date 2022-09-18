<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\Tests;

use Mkioschi\ValueObjects\PhoneNumber\PhoneNumber;
use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_br_phone_number()
    {
        $phoneNumber = new PhoneNumber('55 41 991618888');
        $this->assertInstanceOf(PhoneNumber::class, $phoneNumber);
        $this->assertEquals('55 41 991618888', $phoneNumber->getValue());
        $this->assertEquals('55 41 991618888', (string)$phoneNumber);
        $this->assertEquals('+55 (41) 99161-8888', $phoneNumber->getHumansFormat());
        $this->assertEquals('+5541991618888', $phoneNumber->getE164Format());
        $this->assertEquals('5541991618888', $phoneNumber->getWhatsAppFormat());
        $this->assertEquals('+55*******8888', $phoneNumber->getHiddenFormat());
        $this->assertEquals('+55#######8888', $phoneNumber->getHiddenFormat('#'));

        $this->assertInstanceOf(PhoneNumber::class, new PhoneNumber('+55 (41) 99161-8888'));
    }

    public function test_should_be_able_to_create_a_valid_us_phone_number()
    {
        $phoneNumber = new PhoneNumber('1 978 5965351');
        $this->assertInstanceOf(PhoneNumber::class, $phoneNumber);
        $this->assertEquals('1 978 5965351', $phoneNumber->getValue());
        $this->assertEquals('1 978 5965351', (string)$phoneNumber);
        $this->assertEquals('+1 978 596-5351', $phoneNumber->getHumansFormat());
        $this->assertEquals('+19785965351', $phoneNumber->getE164Format());
        $this->assertEquals('19785965351', $phoneNumber->getWhatsAppFormat());
        $this->assertEquals('+19******5351', $phoneNumber->getHiddenFormat());
        $this->assertEquals('+19######5351', $phoneNumber->getHiddenFormat('#'));

        $this->assertInstanceOf(PhoneNumber::class, new PhoneNumber('+1 (978) 596-5351'));
    }
}