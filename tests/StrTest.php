<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\Tests;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\String\Str;
use Mkioschi\ValueObjects\String\Text;
use Mkioschi\ValueObjects\String\Varchar;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_string()
    {
        $string = new Str('Some string');
        $this->assertInstanceOf(Str::class, $string);
        $this->assertEquals('Some string', $string->getValue());
        $this->assertEquals('Some string', (string)$string);
    }

    public function test_should_not_be_able_to_create_a_string_with_invalid_length()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Str('Some string', 5);
    }

    public function test_should_not_be_able_to_create_a_empty_string()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Str('', null, false);
    }

    public function test_should_be_able_to_create_a_valid_varchar()
    {
        $varchar = new Varchar('Lorem ipsum dolor sit amet');
        $this->assertInstanceOf(Varchar::class, $varchar);
        $this->assertEquals('Lorem ipsum dolor sit amet', $varchar->getValue());
        $this->assertEquals('Lorem ipsum dolor sit amet', (string)$varchar);
    }

    public function test_should_not_be_able_to_create_a_varchar_with_invalid_length()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Varchar('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas');
    }

    public function test_should_be_able_to_create_a_valid_text()
    {
        $text = new Text('Lorem ipsum dolor sit amet');
        $this->assertInstanceOf(Text::class, $text);
        $this->assertEquals('Lorem ipsum dolor sit amet', $text->getValue());
    }
}