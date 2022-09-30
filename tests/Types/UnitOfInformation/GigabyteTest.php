<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\UnitOfInformation;

use Mkioschi\Types\UnitOfInformation\Gigabyte;
use PHPUnit\Framework\TestCase;

class GigabyteTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_gigabyte()
    {
        $gigabyte = Gigabyte::from(2.6);
        $this->assertInstanceOf(Gigabyte::class, $gigabyte);
        $this->assertEquals(2.6, $gigabyte->getValue());
        $this->assertEquals('2.6', (string)$gigabyte);
        $this->assertEquals('2.6 GB', $gigabyte->getHumansFormat(decimalPlaces: 1));
        $this->assertEquals('2.6 gigabytes', $gigabyte->getHumansFormat(abbreviated: false, decimalPlaces: 1));
        $this->assertEquals('1 gigabyte', Gigabyte::from(1)->getHumansFormat(false));
    }

    public function test_should_not_be_able_to_create_a_valid_null_gigabyte()
    {
        $this->assertEquals(null, Gigabyte::innFrom(null));
        $this->assertEquals(null, Gigabyte::innFromMegabytes(null));
        $this->assertEquals(null, Gigabyte::innFromKilobytes(null));
        $this->assertEquals(null, Gigabyte::innFromBytes(null));
    }

    public function test_should_be_able_to_create_a_valid_gigabyte_from_bytes()
    {
        $gigabyte = Gigabyte::fromBytes(2147483648);
        $this->assertEquals(2, $gigabyte->getValue());
        $this->assertEquals(2147483648, $gigabyte->toBytes());
    }

    public function test_should_be_able_to_create_a_valid_gigabyte_from_kilobytes()
    {
        $gigabyte = Gigabyte::fromKilobytes(2097152);
        $this->assertEquals(2, $gigabyte->getValue());
        $this->assertEquals(2097152, $gigabyte->toKilobytes());
    }

    public function test_should_be_able_to_create_a_valid_gigabyte_from_megabytes()
    {
        $gigabyte = Gigabyte::fromMegabytes(1024);
        $this->assertEquals(1, $gigabyte->getValue());
        $this->assertEquals(1024, $gigabyte->toMegabytes());
    }
}