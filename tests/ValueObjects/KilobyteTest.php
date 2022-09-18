<?php declare(strict_types=1);

namespace Mkioschi\Tests\ValueObjects;

use Mkioschi\ValueObjects\UnitOfInformation\Kilobyte;
use PHPUnit\Framework\TestCase;

class KilobyteTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_kilobyte()
    {
        $kilobyte = new Kilobyte(12);
        $this->assertInstanceOf(Kilobyte::class, $kilobyte);
        $this->assertEquals(12, $kilobyte->getValue());
        $this->assertEquals('12', (string)$kilobyte);
        $this->assertEquals('12 KB', $kilobyte->getHumansFormat());
        $this->assertEquals('12 Kilobytes', $kilobyte->getHumansFormat(false));
        $this->assertEquals('1 Kilobyte', (new Kilobyte(1))->getHumansFormat(false));
    }

    public function test_should_be_able_to_create_a_valid_kilobyte_from_bytes()
    {
        $kilobyte = Kilobyte::fromBytes(1024);
        $this->assertEquals(1, $kilobyte->getValue());
        $this->assertEquals(1024, $kilobyte->toBytes());
    }

    public function test_should_be_able_to_create_a_valid_kilobyte_from_megabytes()
    {
        $kilobyte = Kilobyte::fromMegabytes(5);
        $this->assertEquals(5120, $kilobyte->getValue());
        $this->assertEquals(5, $kilobyte->toMegabytes());
    }

    public function test_should_be_able_to_create_a_valid_kilobyte_from_gigabytes()
    {
        $kilobyte = Kilobyte::fromGigabytes(2);
        $this->assertEquals(2097152, $kilobyte->getValue());
        $this->assertEquals(2, $kilobyte->toGigabytes());
    }
}