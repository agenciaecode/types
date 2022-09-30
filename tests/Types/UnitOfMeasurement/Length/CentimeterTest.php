<?php declare(strict_types=1);

namespace Mkioschi\Tests\Types\UnitOfMeasurement\Length;

use Mkioschi\Types\UnitOfMeasurement\Length\Centimeter;
use PHPUnit\Framework\TestCase;

class CentimeterTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_centimeter()
    {
        $this->assertInstanceOf(Centimeter::class, Centimeter::from(105));
        $this->assertEquals(105, Centimeter::from(105)->getValue());
        $this->assertEquals('105', (string)Centimeter::from(105));
        $this->assertEquals('105 cm', Centimeter::from(105)->getHumansFormat());
        $this->assertEquals('105 centimeters', Centimeter::from(105)->getHumansFormat(false));
        $this->assertEquals('1 centimeter', Centimeter::from(1)->getHumansFormat(false));
        $this->assertEquals('1 centimeter', Centimeter::innFrom(1)->getHumansFormat(false));
    }

    public function test_should_not_be_able_to_create_a_valid_null_centimeter()
    {
        $this->assertEquals(null, Centimeter::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_centimeter_from_millimeters()
    {
        $centimeter = Centimeter::fromMillimeters(100);
        $this->assertInstanceOf(Centimeter::class, $centimeter);
        $this->assertEquals(10, $centimeter->getValue());
        $this->assertEquals(100, $centimeter->toMillimeters());
    }

    public function test_should_be_able_to_create_a_valid_centimeter_from_meters()
    {
        $centimeter = Centimeter::fromMeters(100);
        $this->assertInstanceOf(Centimeter::class, $centimeter);
        $this->assertEquals(10000, $centimeter->getValue());
        $this->assertEquals(100, $centimeter->toMeters());
    }

    public function test_should_be_able_to_create_a_valid_centimeter_from_inches()
    {
        $centimeter = Centimeter::fromInches(50);
        $this->assertInstanceOf(Centimeter::class, $centimeter);
        $this->assertEquals(127, $centimeter->getValue());
        $this->assertEquals(50, $centimeter->toInches());
    }

    public function test_should_be_able_to_create_a_valid_centimeter_from_feet()
    {
        $centimeter = Centimeter::fromFeet(2);
        $this->assertInstanceOf(Centimeter::class, $centimeter);
        $this->assertEquals(60.96, $centimeter->getValue());
        $this->assertEquals(2, $centimeter->toFeet());
    }
}