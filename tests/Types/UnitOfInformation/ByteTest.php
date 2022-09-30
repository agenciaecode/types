<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\UnitOfInformation;

use Mkioschi\Types\UnitOfInformation\Byte;
use PHPUnit\Framework\TestCase;

class ByteTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_byte()
    {
        $byte = Byte::from(123000);
        $this->assertInstanceOf(Byte::class, $byte);
        $this->assertEquals(123000, $byte->getValue());
        $this->assertEquals('123000', (string)$byte);
        $this->assertEquals('123000 B', $byte->getHumansFormat());
        $this->assertEquals('123000 Bytes', $byte->getHumansFormat(false));
        $this->assertEquals('1 Byte', Byte::from(1)->getHumansFormat(false));
    }

    public function test_should_be_able_to_create_a_valid_byte_from_kilobytes()
    {
        $byte = Byte::fromKilobytes(1);
        $this->assertEquals(1024, $byte->getValue());
        $this->assertEquals(1, $byte->toKilobytes());
    }

    public function test_should_be_able_to_create_a_valid_byte_from_megabytes()
    {
        $byte = Byte::fromMegabytes(5);
        $this->assertEquals(5242880, $byte->getValue());
        $this->assertEquals(5, $byte->toMegabytes());
    }

    public function test_should_be_able_to_create_a_valid_byte_from_gigabytes()
    {
        $byte = Byte::fromGigabytes(1.234);
        $this->assertEquals(1324997410.816, $byte->getValue());
        $this->assertEquals('1324997410.82 B', $byte->getHumansFormat());
        $this->assertEquals(1.234, $byte->toGigabytes());
    }
}