<?php declare(strict_types=1);

namespace Ecode\Tests\Types\Address;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\Address\ZipCode;
use PHPUnit\Framework\TestCase;

class ZipCodeTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_zip_code()
    {
        $zipCode = ZipCode::from('87209-010');
        $this->assertInstanceOf(ZipCode::class, $zipCode);
        $this->assertEquals('87209010', $zipCode->getValue());
        $this->assertEquals('87209010', (string)$zipCode);

        $zipCode = ZipCode::from('87209010');
        $this->assertEquals('87209-010', $zipCode->getHumansFormat());
    }

    public function test_should_not_be_able_to_create_a_zip_code_with_alpha_numeric()
    {
        $this->expectException(InvalidTypeHttpException::class);
        ZipCode::from('ABCDE-FGH');
    }

    public function test_should_not_be_able_to_create_a_zip_code_with_more_chars_then_need()
    {
        $this->expectException(InvalidTypeHttpException::class);
        ZipCode::from('872090-010');
    }

    public function test_should_not_be_able_to_create_a_zip_code_with_less_chars_then_need()
    {
        $this->expectException(InvalidTypeHttpException::class);
        ZipCode::from('87209-01');
    }
}