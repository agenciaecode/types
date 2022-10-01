<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\UnitOfInformation;

use Mkioschi\Types\UnitOfInformation\Megabyte;
use PHPUnit\Framework\TestCase;

class MegabyteTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_megabyte()
    {
        $this->assertInstanceOf(Megabyte::class, Megabyte::from(6.5));
        $this->assertEquals(6.5, Megabyte::from(6.5)->getValue());
        $this->assertEquals('6.5', (string)Megabyte::from(6.5));
        $this->assertEquals('6.5 MB', Megabyte::from(6.5)->getHumansFormat(decimalPlaces: 1));
        $this->assertEquals('6.5 megabytes', Megabyte::from(6.5)->getHumansFormat(abbreviated: false, decimalPlaces: 1));
        $this->assertEquals('1 megabyte', Megabyte::from(1)->getHumansFormat(false));
        $this->assertEquals(null, Megabyte::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_megabyte_from_bytes()
    {
        $this->assertEquals(6, Megabyte::fromBytes(6291456)->getValue());
        $this->assertEquals(6291456, Megabyte::fromBytes(6291456)->toBytes());
        $this->assertEquals(null, Megabyte::innFromBytes(null));
    }

    public function test_should_be_able_to_create_a_valid_megabyte_from_kilobytes()
    {
        $this->assertEquals(6, Megabyte::fromKilobytes(6144)->getValue());
        $this->assertEquals(6144, Megabyte::fromKilobytes(6144)->toKilobytes());
        $this->assertEquals(null, Megabyte::innFromKilobytes(null));
    }

    public function test_should_be_able_to_create_a_valid_megabyte_from_gigabytes()
    {
        $this->assertEquals(1259.52, Megabyte::fromGigabytes(1.23)->getValue());
        $this->assertEquals(1.23, Megabyte::fromGigabytes(1.23)->toGigabytes());
        $this->assertEquals(null, Megabyte::innFromGigabytes(null));
    }
}
