<?php declare(strict_types=1);

namespace Mkioschi\Tests\ValueObjects\UnitOfMeasurement\Length;

use Mkioschi\ValueObjects\UnitOfMeasurement\Length\Centimeter;
use PHPUnit\Framework\TestCase;

class CentimeterTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_centimeter()
    {
        $centimeter = new Centimeter(105);
        $this->assertInstanceOf(Centimeter::class, $centimeter);
        $this->assertEquals(105, $centimeter->getValue());
        $this->assertEquals('105', (string)$centimeter);
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