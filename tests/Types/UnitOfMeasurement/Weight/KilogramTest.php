<?php declare(strict_types=1);

namespace Ecode\Tests\Types\UnitOfMeasurement\Weight;

use Ecode\Types\UnitOfMeasurement\Weight\Kilogram;
use PHPUnit\Framework\TestCase;

class KilogramTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_kilogram()
    {
        $this->assertInstanceOf(Kilogram::class, Kilogram::from(16));
        $this->assertEquals(16, Kilogram::from(16)->value);
        $this->assertEquals('16', (string)Kilogram::from(16));
        $this->assertEquals('16 kg', Kilogram::from(16)->getHumansFormat());
        $this->assertEquals('16 kilograms', Kilogram::from(16)->getHumansFormat(false));
        $this->assertEquals('1 kilogram', Kilogram::from(1)->getHumansFormat(false));
        $this->assertEquals('1 kilogram', Kilogram::innFrom(1)->getHumansFormat(false));
        $this->assertEquals(null, Kilogram::innFrom(null));
    }

    public function test_should_be_able_to_create_a_valid_kilogram_from_grams()
    {
        $this->assertInstanceOf(Kilogram::class, Kilogram::fromGrams(1500));
        $this->assertEquals(null, Kilogram::innFromGrams(null));
        $this->assertEquals(1.6, Kilogram::fromGrams(1600)->value);
        $this->assertEquals(1600, Kilogram::fromGrams(1600)->toGrams()->value);
    }

    public function test_should_be_able_to_create_a_valid_kilogram_from_pounds()
    {
        $this->assertInstanceOf(Kilogram::class, Kilogram::fromPounds(1));
        $this->assertEquals(null, Kilogram::innFromPounds(null));
        $this->assertEquals(453.59237, Kilogram::fromPounds(1000)->value);
        $this->assertEquals('1000 lbs', Kilogram::fromPounds(1000)->toPounds()->getHumansFormat());
    }

    public function test_should_be_able_to_create_a_valid_kilogram_from_ounces()
    {
        $this->assertInstanceOf(Kilogram::class, Kilogram::fromOunces(10));
        $this->assertEquals(null, Kilogram::innFromOunces(null));
        $this->assertEquals(283.495231, Kilogram::fromOunces(10000)->value);
        $this->assertEquals('100 oz', Kilogram::fromOunces(100)->toOunces()->getHumansFormat());
    }
}