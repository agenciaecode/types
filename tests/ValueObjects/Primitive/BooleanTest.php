<?php declare(strict_types=1);

namespace Mkioschi\Tests\ValueObjects\Primitive;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\Primitive\Boolean;
use PHPUnit\Framework\TestCase;

class BooleanTest extends TestCase
{
    /**
     * @throws InvalidValueHttpException
     */
    public function test_should_be_able_to_create_a_valid_zip_code()
    {
        $boolean = Boolean::from(true);
        $this->assertInstanceOf(Boolean::class, $boolean);
        $this->assertEquals(true, $boolean->getValue());
        $this->assertEquals('true', (string)$boolean);
    }
}