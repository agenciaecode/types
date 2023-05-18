<?php declare(strict_types=1);

namespace Ecode\Tests\Types;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\Numeric;
use Ecode\Types\UnitOfInformation\Byte;
use Exception;
use PHPUnit\Framework\TestCase;

class NumericTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_create_a_numeric_type()
    {
        $this->assertInstanceOf(Numeric::class, Numeric::from(123));
        $this->assertEquals(0, Numeric::fromZero()->value);
        $this->assertEquals(0, Numeric::init()->value);
        $this->assertEquals('123', (string)Numeric::from(123));
        $this->assertEquals(123, Numeric::tryFrom(123)->value);
        $this->assertEquals(123, Numeric::innFrom(123)->value);
        $this->assertEquals(null, Numeric::innFrom(null));
    }

    /**
     * @throws Exception
     */
    public function test_should_be_able_to_validate_a_numeric_type_value()
    {
        $this->assertTrue(Numeric::isValid(123));
        $this->assertTrue(Numeric::isValid(123.45));
        $this->assertFalse(Numeric::isValid('123'));
        $this->assertFalse(Numeric::isValid(['host' => 'github.com']));
    }

    /**
     * @throws Exception
     */
    public function test_should_not_be_able_to_compare_value_with_numeric_type()
    {
        $this->expectException(InvalidTypeHttpException::class);
        $this->assertTrue(Numeric::from(20)->lessThan(Byte::from(1000)));
    }

    /**
     * @throws Exception
     */
    public function test_should_be_able_to_compares_values_with_numeric_type()
    {
        $this->assertTrue(Numeric::from(123)->equals(Numeric::from(123)));
        $this->assertFalse(Numeric::from(123)->equals(Numeric::from(321)));
        $this->assertTrue(Numeric::from(20)->lessThan(21));
        $this->assertFalse(Numeric::from(20)->lessThan(19));
        $this->assertTrue(Numeric::from(20)->lessThanOrEqualTo(21));
        $this->assertTrue(Numeric::from(20)->lessThanOrEqualTo(20));
        $this->assertFalse(Numeric::from(20)->lessThanOrEqualTo(19));
        $this->assertTrue(Numeric::from(20)->greaterThan(19));
        $this->assertFalse(Numeric::from(20)->greaterThan(20));
        $this->assertTrue(Numeric::from(20)->greaterThanOrEqualTo(19));
        $this->assertTrue(Numeric::from(20)->greaterThanOrEqualTo(20));
        $this->assertFalse(Numeric::from(20)->greaterThanOrEqualTo(21));
        $this->assertTrue(Numeric::from(20)->equalTo(20));
        $this->assertFalse(Numeric::from(20)->equalTo(21));
        $this->assertFalse(Numeric::from(20)->notEqualTo(20));
        $this->assertTrue(Numeric::from(20)->notEqualTo(21));
        $this->assertTrue(Numeric::from(20)->between(10, 30));
        $this->assertTrue(Numeric::from(20)->betweenOrEqualThen(20, 40));
    }
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_execute_maths_operations_with_numeric_type()
    {
        $this->assertEquals(20, Numeric::from(10)->sum(10)->value);
        $this->assertEquals(10, Numeric::from(20)->minus(10)->value);
        $this->assertEquals(100, Numeric::from(20)->multiply(5)->value);
        $this->assertEquals(4, Numeric::from(20)->divide(5)->value);
        $this->assertEquals(100, Numeric::from(400)->percentage(25)->value);
        $this->assertEquals(500, Numeric::from(400)->sumPercentage(25)->value);
        $this->assertEquals(300, Numeric::from(400)->minusPercentage(25)->value);
        $this->assertEquals(20, Numeric::from(500)->percentageRatio(100));
    }
}
