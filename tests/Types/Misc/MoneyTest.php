<?php declare(strict_types=1);

namespace Ecode\Tests\Types\Misc;

use Ecode\Enums\Currency;
use Ecode\Enums\Locale;
use Ecode\Types\Misc\Money;
use Exception;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_create_a_valid_money()
    {
        $this->assertInstanceOf(Money::class, Money::from(200, Currency::USD));

        $this->assertEquals(
            '$2,199.98',
            Money::from(2199.981234, Currency::USD)->getHumansFormat()
        );

        $this->assertEquals(
            'US$ 2.199,98',
            Money::fromString('$2,199.98', Currency::USD, Locale::EN_US)->getHumansFormat(Locale::PT_BR)
        );

        $this->assertEquals(
            2199,
            Money::from(2199, Currency::USD)->getAmount()
        );

        $this->assertEquals(
            Currency::USD,
            Money::from(2199, Currency::USD)->getCurrency()
        );

        $this->assertEquals(
            "$",
            Money::from(2199, Currency::USD)->getSymbol()
        );

        $this->assertEquals(
            "R$",
            Money::getSymbolByCurrency(Currency::BRL)
        );
    }
}