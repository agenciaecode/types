<?php declare(strict_types=1);

namespace Ecode\Tests\Types\UnitOfInformation;

use Ecode\Types\UnitOfInformation\Kilobyte;
use PHPUnit\Framework\TestCase;

class KilobyteTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_kilobyte()
    {
        $this->assertInstanceOf(Kilobyte::class, Kilobyte::from(12));
        $this->assertEquals(12, Kilobyte::from(12)->getValue());
        $this->assertEquals('12', (string)Kilobyte::from(12));
        $this->assertEquals('12 KB', Kilobyte::from(12)->getHumansFormat());
        $this->assertEquals('12 kilobytes', Kilobyte::from(12)->getHumansFormat(false));
        $this->assertEquals('1 kilobyte', Kilobyte::from(1)->getHumansFormat(false));
        $this->assertEquals(null, Kilobyte::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_kilobyte_from_bytes()
    {
        $this->assertEquals(1, Kilobyte::fromBytes(1024)->getValue());
        $this->assertEquals(1024, Kilobyte::fromBytes(1024)->toBytes()->getValue());
        $this->assertEquals(null, Kilobyte::innFromBytes(null));
    }

    public function test_should_be_able_to_create_a_valid_kilobyte_from_megabytes()
    {
        $this->assertEquals(5120, Kilobyte::fromMegabytes(5)->getValue());
        $this->assertEquals(5, Kilobyte::fromMegabytes(5)->toMegabytes()->getValue());
        $this->assertEquals(null, Kilobyte::innFromMegabytes(null));
    }

    public function test_should_be_able_to_create_a_valid_kilobyte_from_gigabytes()
    {
        $this->assertEquals(2097152, Kilobyte::fromGigabytes(2)->getValue());
        $this->assertEquals(2, Kilobyte::fromGigabytes(2)->toGigabytes()->getValue());
        $this->assertEquals(null, Kilobyte::innFromGigabytes(null));
    }
}
