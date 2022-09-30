<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\UnitOfInformation;

use Mkioschi\Types\UnitOfInformation\Megabyte;
use PHPUnit\Framework\TestCase;

class MegabyteTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_megabyte()
    {
        $megabyte = Megabyte::from(6.5);
        $this->assertInstanceOf(Megabyte::class, $megabyte);
        $this->assertEquals(6.5, $megabyte->getValue());
        $this->assertEquals('6.5', (string)$megabyte);
        $this->assertEquals('6.5 MB', $megabyte->getHumansFormat(decimalPlaces: 1));
        $this->assertEquals('6.5 megabytes', $megabyte->getHumansFormat(abbreviated: false, decimalPlaces: 1));
        $this->assertEquals('1 megabyte', Megabyte::from(1)->getHumansFormat(false));
    }

    public function test_should_not_be_able_to_create_a_valid_null_megabyte()
    {
        $this->assertEquals(null, Megabyte::innFrom(null));
        $this->assertEquals(null, Megabyte::innFromBytes(null));
        $this->assertEquals(null, Megabyte::innFromGigabytes(null));
        $this->assertEquals(null, Megabyte::innFromKilobytes(null));
    }

    public function test_should_be_able_to_create_a_valid_megabyte_from_bytes()
    {
        $megabyte = Megabyte::fromBytes(6291456);
        $this->assertEquals(6, $megabyte->getValue());
        $this->assertEquals(6291456, $megabyte->toBytes());
    }

    public function test_should_be_able_to_create_a_valid_megabyte_from_kilobytes()
    {
        $megabyte = Megabyte::fromKilobytes(6144);
        $this->assertEquals(6, $megabyte->getValue());
        $this->assertEquals(6144, $megabyte->toKilobytes());
    }

    public function test_should_be_able_to_create_a_valid_megabyte_from_gigabytes()
    {
        $megabyte = Megabyte::fromGigabytes(1.23);
        $this->assertEquals(1259.52, $megabyte->getValue());
        $this->assertEquals(1.23, $megabyte->toGigabytes());
    }
}