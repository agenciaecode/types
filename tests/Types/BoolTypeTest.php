<?php declare(strict_types=1);

namespace Ecode\Tests\Types;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\BoolType;
use PHPUnit\Framework\TestCase;

class BoolTypeTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_boolean()
    {
        $this->assertInstanceOf(BoolType::class, BoolType::from(true));
        $this->assertEquals('true', (string)BoolType::from(true));
        $this->assertEquals(false, BoolType::tryFrom(false)->value);
        $this->assertEquals(true, BoolType::innFrom(true)->value);
        $this->assertEquals(null, BoolType::tryFrom('true'));
        $this->assertEquals(null, BoolType::innFrom(null));
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_boolean_from_a_truthy_string()
    {
        $this->assertEquals(null, BoolType::innFromString(null));
        $this->assertEquals(true, BoolType::innFromString('true')->value);
        $this->assertEquals(true, BoolType::fromString('true')->value);
        $this->assertEquals(true, BoolType::fromString('yes')->value);
        $this->assertEquals(true, BoolType::fromString('on')->value);
        $this->assertEquals(true, BoolType::fromString('1')->value);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_boolean_from_a_falsy_string()
    {
        $this->assertEquals(null, BoolType::innFromString(null));
        $this->assertEquals(false, BoolType::innFromString('false')->value);
        $this->assertEquals(false, BoolType::fromString('false')->value);
        $this->assertEquals(false, BoolType::fromString('no')->value);
        $this->assertEquals(false, BoolType::fromString('off')->value);
        $this->assertEquals(false, BoolType::fromString('0')->value);
    }
}
