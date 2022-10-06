<?php declare(strict_types=1);

namespace Ecode\Tests\Types;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\Boolean;
use PHPUnit\Framework\TestCase;

class BooleanTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_boolean()
    {
        $this->assertInstanceOf(Boolean::class, Boolean::from(true));
        $this->assertEquals('true', (string)Boolean::from(true));
        $this->assertEquals(false, Boolean::tryFrom(false)->getValue());
        $this->assertEquals(true, Boolean::innFrom(true)->getValue());
        $this->assertEquals(null, Boolean::tryFrom('true'));
        $this->assertEquals(null, Boolean::innFrom(null));
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_boolean_from_a_truthy_string()
    {
        $this->assertEquals(null, Boolean::innFromString(null));
        $this->assertEquals(true, Boolean::innFromString('true')->getValue());
        $this->assertEquals(true, Boolean::fromString('true')->getValue());
        $this->assertEquals(true, Boolean::fromString('yes')->getValue());
        $this->assertEquals(true, Boolean::fromString('on')->getValue());
        $this->assertEquals(true, Boolean::fromString('1')->getValue());
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_boolean_from_a_falsy_string()
    {
        $this->assertEquals(null, Boolean::innFromString(null));
        $this->assertEquals(false, Boolean::innFromString('false')->getValue());
        $this->assertEquals(false, Boolean::fromString('false')->getValue());
        $this->assertEquals(false, Boolean::fromString('no')->getValue());
        $this->assertEquals(false, Boolean::fromString('off')->getValue());
        $this->assertEquals(false, Boolean::fromString('0')->getValue());
    }
}
