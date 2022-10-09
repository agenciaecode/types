<?php declare(strict_types=1);

namespace Ecode\Tests\Types;

use Ecode\Types\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_str()
    {
        $this->assertInstanceOf(Str::class, Str::from('Some string'));
        $this->assertEquals('Some string', (string)Str::from('Some string'));
        $this->assertEquals(true, Str::from('Some string')->equals(Str::from('Some string')));
        $this->assertEquals(false, Str::from('Some string')->equals(Str::from('Another string')));
        $this->assertEquals('Some string', Str::tryFrom('Some string')->getValue());
        $this->assertEquals('Some string', Str::innFrom('Some string')->getValue());
        $this->assertEquals(null, Str::innFrom(null));
        $this->assertEquals(false, Str::isValid(123));
        $this->assertEquals(false, Str::isValid(['host' => 'github.com']));
        $this->assertEquals(true, Str::isValid('Some string'));
        $this->assertEquals('1123', Str::extractNumbers('Some string 1: 123'));
    }

    public function test_should_be_able_to_slugify_a_string()
    {
        $this->assertEquals('some-string', Str::slugify('Some string'));
    }
}
