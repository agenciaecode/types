<?php declare(strict_types=1);

namespace Ecode\Tests\Types\UnitOfInformation;

use Ecode\Types\UnitOfInformation\Byte;
use PHPUnit\Framework\TestCase;

class ByteTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_byte()
    {
        $this->assertInstanceOf(Byte::class, Byte::from(123000));
        $this->assertEquals(123000, Byte::from(123000)->getValue());
        $this->assertEquals('123000', (string)Byte::from(123000));
        $this->assertEquals('123000 B', Byte::from(123000)->getHumansFormat());
        $this->assertEquals('123000 bytes', Byte::from(123000)->getHumansFormat(false));
        $this->assertEquals('1 byte', Byte::from(1)->getHumansFormat(false));
        $this->assertEquals(null, Byte::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_byte_from_kilobytes()
    {
        $this->assertEquals(1024, Byte::fromKilobytes(1)->getValue());
        $this->assertEquals(1, Byte::fromKilobytes(1)->toKilobytes());
        $this->assertEquals(null, Byte::innFromKilobytes(null));
    }

    public function test_should_be_able_to_create_a_valid_byte_from_megabytes()
    {
        $this->assertEquals(5242880, Byte::fromMegabytes(5)->getValue());
        $this->assertEquals(5, Byte::fromMegabytes(5)->toMegabytes());
        $this->assertEquals(null, Byte::innFromMegabytes(null));
    }

    public function test_should_be_able_to_create_a_valid_byte_from_gigabytes()
    {
        $this->assertEquals(1324997410.816, Byte::fromGigabytes(1.234)->getValue());
        $this->assertEquals(1.234, Byte::fromGigabytes(1.234)->toGigabytes());
        $this->assertEquals(null, Byte::innFromGigabytes(null));
    }
}