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

        $this->assertEquals(
            200.56,
            Money::from(100, Currency::USD)->sum(
                Money::from(100.56, Currency::USD)
            )->getAmount()
        );

        $this->assertEquals(
            2250,
            Money::from(2500, Currency::USD)->minus(
                Money::from(250, Currency::USD)
            )->getAmount()
        );

        $this->assertEquals(
            false,
            Money::from(2500, Currency::USD)->lessThan(
                Money::from(250, Currency::USD)
            )
        );

        $this->assertEquals(
            true,
            Money::from(987, Currency::USD)->lessThanOrEqualTo(
                Money::from(987, Currency::USD)
            )
        );

        $this->assertEquals(
            true,
            Money::from(1274, Currency::USD)->greaterThan(
                Money::from(987, Currency::USD)
            )
        );

        $this->assertEquals(
            true,
            Money::from(894, Currency::USD)->greaterThanOrEqualTo(
                Money::from(894, Currency::USD)
            )
        );

        $this->assertEquals(
            false,
            Money::from(321, Currency::USD)->equalTo(
                Money::from(123, Currency::USD)
            )
        );

        $this->assertEquals(
            true,
            Money::from(321, Currency::USD)->notEqualTo(
                Money::from(123, Currency::USD)
            )
        );

        $this->assertEquals(
            true,
            Money::from(321, Currency::USD)->between(
                Money::from(12, Currency::USD),
                Money::from(556, Currency::USD),
            )
        );

        $this->assertEquals(
            true,
            Money::from(321, Currency::USD)->betweenOrEqualThen(
                Money::from(12, Currency::USD),
                Money::from(321, Currency::USD),
            )
        );

        $this->assertEquals(
            311.25,
            Money::avg(
                Money::from(321, Currency::USD),
                Money::from(456, Currency::USD),
                Money::from(12, Currency::USD),
                Money::from(456, Currency::USD)
            )->getAmount()
        );

        $this->assertEquals(
            100,
            Money::from(400, Currency::USD)
                ->percentage(25)
                ->getAmount()
        );

        $this->assertEquals(
            500,
            Money::from(400, Currency::USD)
                ->sumPercentage(25)
                ->getAmount()
        );

        $this->assertEquals(
            300,
            Money::from(400, Currency::USD)
                ->minusPercentage(25)
                ->getAmount()
        );

        $this->assertEquals(
            20,
            Money::from(500, Currency::USD)
                ->percentageRatio(Money::from(100, Currency::USD))
        );

        $this->assertEquals(null, Money::innFrom(null, Currency::USD));
        $this->assertEquals(null, Money::innFrom(500, null));
        $this->assertEquals(null, Money::innFrom(null, null));
    }
}