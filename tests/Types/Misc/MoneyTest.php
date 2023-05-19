<?php declare(strict_types=1);

namespace Ecode\Tests\Types\Misc;

use Ecode\Enums\Currency;
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
        $this->assertInstanceOf(Money::class, Money::from(200));
        $this->assertEquals('$2,199.98', Money::from(2199.981234)->getHumansFormat());
        $this->assertEquals('-$2,199.98', Money::from(-2199.981234)->getHumansFormat());
        $this->assertEquals(2199, Money::from(2199)->amount);
        $this->assertEquals(Currency::USD, Money::from(2199)->currency);
        $this->assertEquals("$", Money::from(2199)->getSymbol());
        $this->assertEquals("R$", Money::getSymbolByCurrency(Currency::BRL));
        $this->assertEquals(200.56, Money::from(100)->sum(Money::from(100.56))->amount);
        $this->assertEquals(2250, Money::from(2500)->minus(Money::from(250))->amount);
        $this->assertFalse(Money::from(2500)->lessThan(Money::from(250)));
        $this->assertTrue(Money::from(987)->lessThanOrEqualTo(Money::from(987)));
        $this->assertTrue(Money::from(1274)->greaterThan(Money::from(987)));
        $this->assertTrue(Money::from(894)->greaterThanOrEqualTo(Money::from(894)));
        $this->assertFalse(Money::from(321)->equalTo(Money::from(123)));
        $this->assertTrue(Money::from(321)->notEqualTo(Money::from(123)));

        $this->assertTrue(
            Money::from(321)->between(
                Money::from(12),
                Money::from(556),
            )
        );

        $this->assertTrue(
            Money::from(321)->betweenOrEqualThen(
                Money::from(12),
                Money::from(321),
            )
        );

        $this->assertEquals(
            311.25,
            Money::avg(
                Money::from(321),
                Money::from(456),
                Money::from(12),
                Money::from(456)
            )->amount
        );

        $this->assertEquals(
            100,
            Money::from(400)
                ->percentage(25)
                ->amount
        );

        $this->assertEquals(
            500,
            Money::from(400)
                ->sumPercentage(25)
                ->amount
        );

        $this->assertEquals(
            300,
            Money::from(400)
                ->minusPercentage(25)
                ->amount
        );

        $this->assertEquals(
            20,
            Money::from(500)
                ->percentageRatio(Money::from(100))
        );

        $this->assertEquals(
            expected: ['amount' => 20, 'currency' => 'USD'],
            actual: Money::from(20)->toArray()
        );

        $moneyType = Money::from(20);
        $this->assertEquals(
            expected: $moneyType,
            actual: $moneyType->clone()
        );

        $this->assertEquals(
            expected: Money::from(amount: 20),
            actual: Money::from(amount: 40)->divide(divisor: 2)
        );

        $this->assertEquals(
            expected: Money::from(amount: 40),
            actual: Money::from(amount: 10)->multiply(multiplier: 4)
        );

        $this->assertEquals(0, Money::fromZero()->amount);
        $this->assertEquals(0, Money::init()->amount);
        $this->assertEquals(20.1, Money::from(20.1)->round());
        $this->assertEquals(20.16, Money::from(20.15562938)->round());
        $this->assertEquals(null, Money::innFrom(500, null));
        $this->assertEquals(null, Money::innFrom(null, null));

        $this->assertTrue(Money::fromZero()->isNeutral());
        $this->assertFalse(Money::fromZero()->isCredit());
        $this->assertFalse(Money::fromZero()->isDebit());
        $this->assertTrue(Money::from(10)->isCredit());
        $this->assertFalse(Money::from(10)->isDebit());
        $this->assertTrue(Money::from(-10)->isDebit());
        $this->assertFalse(Money::from(-10)->isCredit());

        $this->assertEquals('$10.00', Money::from(10)->toCredit()->getHumansFormat());
        $this->assertEquals('$10.00', Money::from(-10)->toCredit()->getHumansFormat());
        $this->assertEquals('-$10.00', Money::from(10)->toDebit()->getHumansFormat());
        $this->assertEquals('-$10.00', Money::from(-10)->toDebit()->getHumansFormat());
        $this->assertEquals('$0.00', Money::from(0)->toCredit()->getHumansFormat());
        $this->assertEquals('$0.00', Money::from(0)->toDebit()->getHumansFormat());
    }
}