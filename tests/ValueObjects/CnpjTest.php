<?php declare(strict_types=1);

namespace Mkioschi\Tests\ValueObjects;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\Cnpj;
use PHPUnit\Framework\TestCase;

class CnpjTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_cnpj()
    {
        $cnpj = new Cnpj('67.947.309/0001-64');
        $this->assertInstanceOf(Cnpj::class, $cnpj);
        $this->assertEquals('67947309000164', $cnpj->getValue());
        $this->assertEquals('67947309000164', (string)$cnpj);

        $cnpj = new Cnpj('67947309000164');
        $this->assertEquals('67.947.309/0001-64', $cnpj->getHumansFormat());
    }

    public function test_should_not_be_able_to_create_a_cnpj()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('67.947.309/0001-60');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_0()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('00.000.000/0000-00');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_1()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('11.111.111/1111-11');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_2()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('22.222.222/2222-22');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_3()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('33.333.333/3333-33');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_4()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('44.444.444/4444-44');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_5()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('55.555.555/5555-55');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_6()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('66.666.666/6666-66');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_7()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('77.777.777/7777-77');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_8()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('88.888.888/8888-88');
    }

    public function test_should_not_be_able_to_create_a_cnpj_with_same_digits_9()
    {
        $this->expectException(InvalidValueHttpException::class);
        new Cnpj('99.999.999/9999-99');
    }
}