<?php declare(strict_types=1);

namespace Ecode\Tests\Types;

use Ecode\Types\Integer;
use PHPUnit\Framework\TestCase;

class IntegerTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_integer()
    {
        $this->assertInstanceOf(Integer::class, Integer::from(123));
        $this->assertEquals('123', (string)Integer::from(123));
        $this->assertEquals(true, Integer::from(123)->equals(Integer::from(123)));
        $this->assertEquals(false, Integer::from(123)->equals(Integer::from(321)));
        $this->assertEquals(123, Integer::tryFrom(123)->getValue());
        $this->assertEquals(123, Integer::innFrom(123)->getValue());
        $this->assertEquals(null, Integer::innFrom(null));
        $this->assertEquals(true, Integer::isValid(123));
        $this->assertEquals(false, Integer::isValid(123.45));
        $this->assertEquals(false, Integer::isValid('123'));
        $this->assertEquals(false, Integer::isValid(['host' => 'github.com']));
    }
}
