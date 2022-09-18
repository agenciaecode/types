<?php declare(strict_types=1);

namespace Mkioschi\Tests\ValueObjects;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_cpf()
    {
        $cpf = new Cpf('732.376.660-50');
        $this->assertInstanceOf(Cpf::class, $cpf);
        $this->assertEquals('73237666050', $cpf->getValue());
        $this->assertEquals('73237666050', (string)$cpf);

        $cpf = new Cpf('36749457037');
        $this->assertEquals('367.494.570-37', $cpf->getHumansFormat());
    }

    public function test_should_not_be_able_to_create_a_cpf()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('732.376.661-50');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_0()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('000.000.000-000');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_1()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('111.111.111-111');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_2()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('222.222.222-222');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_3()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('333.333.333-333');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_4()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('444.444.444-444');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_5()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('555.555.555-555');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_6()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('666.666.666-666');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_7()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('777.777.777-777');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_8()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('888.888.888-888');
    }

    public function test_should_not_be_able_to_create_a_cpf_with_same_digits_9()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cpf('999.999.999-999');
    }
}