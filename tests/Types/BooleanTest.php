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
        $this->assertEquals(false, Boolean::tryFrom(false)->value);
        $this->assertEquals(true, Boolean::innFrom(true)->value);
        $this->assertEquals(null, Boolean::tryFrom('true'));
        $this->assertEquals(null, Boolean::innFrom(null));
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_boolean_from_a_truthy_string()
    {
        $this->assertEquals(null, Boolean::innFromString(null));
        $this->assertEquals(true, Boolean::innFromString('true')->value);
        $this->assertEquals(true, Boolean::fromString('true')->value);
        $this->assertEquals(true, Boolean::fromString('yes')->value);
        $this->assertEquals(true, Boolean::fromString('on')->value);
        $this->assertEquals(true, Boolean::fromString('1')->value);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_boolean_from_a_falsy_string()
    {
        $this->assertEquals(null, Boolean::innFromString(null));
        $this->assertEquals(false, Boolean::innFromString('false')->value);
        $this->assertEquals(false, Boolean::fromString('false')->value);
        $this->assertEquals(false, Boolean::fromString('no')->value);
        $this->assertEquals(false, Boolean::fromString('off')->value);
        $this->assertEquals(false, Boolean::fromString('0')->value);
    }
}
