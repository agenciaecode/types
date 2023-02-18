<?php declare(strict_types=1);

namespace Ecode\Tests\Types;

use Ecode\Types\Numeric;
use PHPUnit\Framework\TestCase;

class NumericTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_numeric()
    {
        $this->assertInstanceOf(Numeric::class, Numeric::from(123));
        $this->assertEquals('123', (string)Numeric::from(123));
        $this->assertEquals(true, Numeric::from(123)->equals(Numeric::from(123)));
        $this->assertEquals(false, Numeric::from(123)->equals(Numeric::from(321)));
        $this->assertEquals(123, Numeric::tryFrom(123)->value);
        $this->assertEquals(123, Numeric::innFrom(123)->value);
        $this->assertEquals(null, Numeric::innFrom(null));
        $this->assertEquals(true, Numeric::isValid(123));
        $this->assertEquals(true, Numeric::isValid(123.45));
        $this->assertEquals(false, Numeric::isValid('123'));
        $this->assertEquals(false, Numeric::isValid(['host' => 'github.com']));
    }
}
