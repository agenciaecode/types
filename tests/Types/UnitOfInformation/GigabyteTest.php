<?php declare(strict_types=1);

namespace Ecode\Tests\Types\UnitOfInformation;

use Ecode\Types\UnitOfInformation\Gigabyte;
use PHPUnit\Framework\TestCase;

class GigabyteTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_gigabyte()
    {
        $this->assertInstanceOf(Gigabyte::class, Gigabyte::from(2.6));
        $this->assertEquals(2.6, Gigabyte::from(2.6)->getValue());
        $this->assertEquals('2.6', (string)Gigabyte::from(2.6));
        $this->assertEquals('2.6 GB', Gigabyte::from(2.6)->getHumansFormat(maxDecimalPlaces: 1));
        $this->assertEquals('2.6 gigabytes', Gigabyte::from(2.6)->getHumansFormat(abbreviated: false, maxDecimalPlaces: 1));
        $this->assertEquals('1 gigabyte', Gigabyte::from(1)->getHumansFormat(false));
        $this->assertEquals(null, Gigabyte::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_gigabyte_from_bytes()
    {
        $this->assertEquals(2, Gigabyte::fromBytes(2147483648)->getValue());
        $this->assertEquals(2147483648, Gigabyte::fromBytes(2147483648)->toBytes()->getValue());
        $this->assertEquals(null, Gigabyte::innFromBytes(null));
    }

    public function test_should_be_able_to_create_a_valid_gigabyte_from_kilobytes()
    {
        $this->assertEquals(2, Gigabyte::fromKilobytes(2097152)->getValue());
        $this->assertEquals(2097152, Gigabyte::fromKilobytes(2097152)->toKilobytes()->getValue());
        $this->assertEquals(null, Gigabyte::innFromKilobytes(null));
    }

    public function test_should_be_able_to_create_a_valid_gigabyte_from_megabytes()
    {
        $this->assertEquals(1, Gigabyte::fromMegabytes(1024)->getValue());
        $this->assertEquals(1024, Gigabyte::fromMegabytes(1024)->toMegabytes()->getValue());
        $this->assertEquals(null, Gigabyte::innFromMegabytes(null));
    }
}
