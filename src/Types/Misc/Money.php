<?php declare(strict_types=1);

namespace Ecode\Types\Misc;

use Ecode\Enums\Currency;
use Ecode\Enums\Locale;
use Ecode\Types\AbstractType;
use Ecode\Types\Numeric;
use Exception;
use NumberFormatter;

final class Money extends AbstractType
{
    public readonly float $amount;
    public readonly Currency $currency;

    private function __construct(float $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function from(float $amount, Currency $currency = Currency::USD): Money
    {
        return new Money($amount, $currency);
    }

    public static function fromZero(Currency $currency = Currency::USD): Money
    {
        return new Money(0, $currency);
    }

    public static function init(Currency $currency = Currency::USD): Money
    {
        return self::fromZero($currency);
    }

    public static function innFrom(?float $amount, ?Currency $currency = Currency::USD): ?Money
    {
        if (is_null($amount) || is_null($currency)) {
            return null;
        }

        return new Money($amount, $currency);
    }

    public function getHumansFormat(Locale $locale = Locale::EN_US): string
    {
        $formatter = new NumberFormatter($locale->value, NumberFormatter::CURRENCY);
        $formattedString = $formatter->formatCurrency($this->amount, $this->currency->value);
        return str_replace("\xc2\xa0", " ", $formattedString);
    }

    public function __toString(): string
    {
        return $this->getHumansFormat();
    }

    public function getSymbol(Locale $locale = Locale::EN_US): string
    {
        return self::getSymbolByCurrency($this->currency, $locale);
    }

    public static function getSymbolByCurrency(Currency $currency, Locale $locale = Locale::EN_US): string
    {
        $formatter = new NumberFormatter(
            "$locale->value@currency=$currency->value",
            NumberFormatter::CURRENCY
        );
        $symbol = $formatter->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
        return str_replace("\xc2\xa0", " ", $symbol);
    }

    /**
     * @throws Exception
     */
    public static function currenciesAreTheSame(Currency ...$currencies): bool
    {
        if (count($currencies) < 2) {
            throw new Exception('At least two currencies are required.');
        }

        $baseCurrency = array_shift($currencies);

        foreach ($currencies as $currency) {
            if ($baseCurrency !== $currency) {
                return false;
            }
        }

        return true;
    }

    /**
     * @throws Exception
     */
    private function normalize(float|int|Money $value): float|int
    {
        if (is_int($value) || is_float($value)) {
            return $value;
        }

        if ($this->currency !== $value->currency) {
            throw new Exception('The currencies are not the same.');
        }

        return $value->amount;
    }

    /**
     * @throws Exception
     */
    public function sum(float|int|Money $value): Money
    {
        $result = $this->amount + $this->normalize($value);
        return Money::from($result, $this->currency);
    }

    /**
     * @throws Exception
     */
    public function minus(float|int|Money $value): Money
    {
        $result = $this->amount - $this->normalize($value);
        return Money::from($result, $this->currency);
    }

    public function multiply(int|float $multiplier): Money
    {
        return new Money(
            amount: $this->amount * $multiplier,
            currency: $this->currency
        );
    }

    public function divide(int|float $divisor): Money
    {
        return new Money(
            amount: $this->amount / $divisor,
            currency: $this->currency
        );
    }

    /**
     * @throws Exception
     */
    public function lessThan(float|int|Money $value): bool
    {
        return $this->amount < $this->normalize($value);
    }

    /**
     * @throws Exception
     */
    public function lessThanOrEqualTo(float|int|Money $value): bool
    {
        return $this->amount <= $this->normalize($value);
    }

    /**
     * @throws Exception
     */
    public function greaterThan(float|int|Money $value): bool
    {
        return $this->amount > $this->normalize($value);
    }

    /**
     * @throws Exception
     */
    public function greaterThanOrEqualTo(float|int|Money $value): bool
    {
        return $this->amount >= $this->normalize($value);
    }

    /**
     * @throws Exception
     */
    public function equalTo(float|int|Money $value): bool
    {
        return $this->amount === $this->normalize($value);
    }

    /**
     * @throws Exception
     */
    public function notEqualTo(float|int|Money $value): bool
    {
        return $this->amount !== $this->normalize($value);
    }

    /**
     * @throws Exception
     */
    public function between(float|int|Money $minValue, float|int|Money $maxValue): bool
    {
        return $this->amount > $this->normalize($minValue) && $this->amount < $this->normalize($maxValue);
    }

    /**
     * @throws Exception
     */
    public function betweenOrEqualThen(float|int|Money $minValue, float|int|Money $maxValue): bool
    {
        return $this->amount >= $this->normalize($minValue) && $this->amount <= $this->normalize($maxValue);
    }

    /**
     * @throws Exception
     */
    public static function avg(Money ...$values): Money
    {
        $currencies = [];
        $totalValues = count($values);
        $sum = 0;

        if ($totalValues < 2) {
            throw new Exception('At least two currencies are required to calculate average.');
        }

        foreach ($values as $value) {
            $currencies[] = $value->currency;
            $sum += $value->amount;
        }

        if (!self::currenciesAreTheSame(...$currencies)) {
            throw new Exception('All currencies must be equals.');
        }

        $avg = $sum / $totalValues;

        return Money::from($avg, array_shift($currencies));
    }

    public function percentage(int|float $ratio): Money
    {
        return Money::from(
            amount: $this->amount / 100 * $ratio,
            currency: $this->currency
        );
    }

    public function sumPercentage(int|float $ratio): Money
    {
        return Money::from(
            amount: $this->amount + ($this->amount / 100 * $ratio),
            currency: $this->currency
        );
    }

    public function minusPercentage(int|float $ratio): Money
    {
        return Money::from(
            amount: $this->amount - ($this->amount / 100 * $ratio),
            currency: $this->currency
        );
    }

    /**
     * @throws Exception
     */
    public function percentageRatio(float|int|Money $value): int|float
    {
        return $this->normalize($value) / $this->amount * 100;
    }

    public static function roundAmount(float $amount): float
    {
        return round(num: $amount, precision: 2);
    }

    public function round(): float {
        return self::roundAmount(amount: $this->amount);
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency->value,
        ];
    }

    public function isNeutral(): bool
    {
        return Numeric::valueIsNeutral($this->amount);
    }

    public function isCredit(): bool
    {
        return Numeric::valueIsPositive($this->amount);
    }

    public function isDebit(): bool
    {
        return Numeric::valueIsNegative($this->amount);
    }

    public function toCredit(): Money
    {
        if ($this->isNeutral()) {
            return $this->clone();
        }

        return new Money(
            amount: Numeric::convertToPositive($this->amount),
            currency: $this->currency
        );
    }

    public function toDebit(): Money
    {
        if ($this->isNeutral()) {
            return $this->clone();
        }

        return new Money(
            amount: Numeric::convertToNegative($this->amount),
            currency: $this->currency
        );
    }
}
