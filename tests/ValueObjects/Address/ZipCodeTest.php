<?php declare(strict_types=1);

namespace Mkioschi\Tests\ValueObjects\Address;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\Address\ZipCode;
use PHPUnit\Framework\TestCase;

class ZipCodeTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_zip_code()
    {
        $zipCode = new ZipCode('87209-010');
        $this->assertInstanceOf(ZipCode::class, $zipCode);
        $this->assertEquals('87209010', $zipCode->getValue());
        $this->assertEquals('87209010', (string)$zipCode);

        $zipCode = new ZipCode('87209010');
        $this->assertEquals('87209-010', $zipCode->getHumansFormat());
    }

    public function test_should_not_be_able_to_create_a_zip_code_with_alpha_numeric()
    {
        $this->expectException(InvalidValueHttpException::class);
        new ZipCode('ABCDE-FGH');
    }

    public function test_should_not_be_able_to_create_a_zip_code_with_more_chars_then_need()
    {
        $this->expectException(InvalidValueHttpException::class);
        new ZipCode('872090-010');
    }

    public function test_should_not_be_able_to_create_a_zip_code_with_less_chars_then_need()
    {
        $this->expectException(InvalidValueHttpException::class);
        new ZipCode('87209-01');
    }
}