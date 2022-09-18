<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\Tests;

use Mkioschi\ValueObjects\Boolean;
use PHPUnit\Framework\TestCase;

class BooleanTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_zip_code()
    {
        $boolean = new Boolean(true);
        $this->assertInstanceOf(Boolean::class, $boolean);
        $this->assertEquals(true, $boolean->getValue());
        $this->assertEquals('true', (string)$boolean);
    }
}