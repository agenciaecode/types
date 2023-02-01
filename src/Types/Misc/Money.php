<?php declare(strict_types=1);

namespace Ecode\Types\Misc;

use Ecode\Enums\Currency;
use Ecode\Enums\Locale;
use Exception;
use NumberFormatter;

final class Money
{
    /** @var float|int */
    private float|int $amount;

    /** @var Currency */
    private Currency $currency;

    /**
     * @param float|int $amount
     * @param Currency $currency
     */
    private function __construct(float|int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param mixed $amount
     * @param Currency $currency
     * @return bool
     */
    public static function isValid(mixed $amount, Currency $currency): bool
    {
        if (!is_int($amount) && !is_float($amount)) return false;
        return true;
    }

    /**
     * @param float|int $amount
     * @param Currency $currency
     * @return Money
     */
    public static function from(float|int $amount, Currency $currency): Money
    {
        return new Money($amount, $currency);
    }

    /**
     * @param string $string
     * @param Currency $currency
     * @param Locale $locale
     * @return Money
     * @throws Exception
     */
    public static function fromString(
        string $string,
        Currency $currency,
        Locale $locale
    ): Money
    {
        $currencyString = $currency->value;
        $formatter = new NumberFormatter($locale->value, NumberFormatter::CURRENCY);
        $amount = $formatter->parseCurrency($string, $currencyString);
        if (! $amount) throw new Exception("Invalid money string.");
        return new Money($amount, $currency);
    }

    /**
     * @param Locale $locale
     * @return string
     */
    public function getHumansFormat(Locale $locale = Locale::EN_US): string
    {
        $formatter = new NumberFormatter($locale->value, NumberFormatter::CURRENCY);
        $formattedString = $formatter->formatCurrency($this->amount, $this->getCurrency()->value);
        return str_replace("\xc2\xa0", " ", $formattedString);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getHumansFormat();
    }

    /**
     * @return float|int
     */
    public function getAmount(): float|int
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @param Locale $locale
     * @return string
     */
    public function getSymbol(Locale $locale = Locale::EN_US): string
    {
        return self::getSymbolByCurrency($this->currency, $locale);
    }

    /**
     * @param Currency $currency
     * @param Locale $locale
     * @return string
     */
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
     * @param Currency ...$currencies
     * @return bool
     * @throws Exception
     */
    private static function currenciesAreTheSame(Currency ...$currencies): bool
    {
        if (count($currencies) < 2) throw new Exception('At least two currencies are required.');

        $baseCurrency = array_shift($currencies);

        foreach ($currencies as $currency) {
            if ($baseCurrency !== $currency) return false;
        }

        return true;
    }

    /**
     * @param Currency ...$currencies
     * @return void
     * @throws Exception
     */
    private function validateCurrencies(Currency ...$currencies): void
    {
        if (!self::currenciesAreTheSame($this->currency, ...$currencies))
            throw new Exception('The currencies are not the same.');
    }

    /**
     * @param Money $value
     * @return Money
     * @throws Exception
     */
    public function sum(Money $value): Money
    {
        $this->validateCurrencies($value->getCurrency());
        $result = $this->amount + $value->getAmount();
        return Money::from($result, $this->currency);
    }

    /**
     * @param Money $value
     * @return Money
     * @throws Exception
     */
    public function minus(Money $value): Money
    {
        $this->validateCurrencies($value->getCurrency());
        $result = $this->amount - $value->getAmount();
        return Money::from($result, $this->currency);
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function lessThan(Money $value): bool
    {
        $this->validateCurrencies($value->getCurrency());
        return $this->amount < $value->getAmount();
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function lessThanOrEqualTo(Money $value): bool
    {
        $this->validateCurrencies($value->getCurrency());
        return $this->amount <= $value->getAmount();
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function greaterThan(Money $value): bool
    {
        $this->validateCurrencies($value->getCurrency());
        return $this->amount > $value->getAmount();
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function greaterThanOrEqualTo(Money $value): bool
    {
        $this->validateCurrencies($value->getCurrency());
        return $this->amount >= $value->getAmount();
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function equalTo(Money $value): bool
    {
        $this->validateCurrencies($value->getCurrency());
        return $this->amount === $value->getAmount();
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function notEqualTo(Money $value): bool
    {
        $this->validateCurrencies($value->getCurrency());
        return $this->amount !== $value->getAmount();
    }

    /**
     * @param Money $minValue
     * @param Money $maxValue
     * @return bool
     * @throws Exception
     */
    public function between(Money $minValue, Money $maxValue): bool
    {
        $this->validateCurrencies($minValue->getCurrency(), $maxValue->getCurrency());
        return $this->amount > $minValue->getAmount() && $this->amount < $maxValue->getAmount();
    }

    /**
     * @param Money $minValue
     * @param Money $maxValue
     * @return bool
     * @throws Exception
     */
    public function betweenOrEqualThen(Money $minValue, Money $maxValue): bool
    {
        $this->validateCurrencies($minValue->getCurrency(), $maxValue->getCurrency());
        return $this->amount >= $minValue->getAmount() && $this->amount <= $maxValue->getAmount();
    }

    /**
     * @param Money ...$values
     * @return Money
     * @throws Exception
     */
    public static function avg(Money ...$values): Money
    {
        $currencies = [];
        $totalValues = count($values);
        $sum = 0;

        if ($totalValues < 2)
            throw new Exception('At least two currencies are required to calculate average.');

        foreach ($values as $value) {
            $currencies[] = $value->getCurrency();
            $sum += $value->getAmount();
        }

        if (!self::currenciesAreTheSame(...$currencies))
            throw new Exception('All currencies must be equals.');

        $avg = $sum / $totalValues;

        return Money::from($avg, array_shift($currencies));
    }

    /**
     * @param int|float $ratio
     * @return Money
     */
    public function percentage(int|float $ratio): Money
    {
        return Money::from(
            amount: $this->amount / 100 * $ratio,
            currency: $this->currency
        );
    }

    /**
     * @param int|float $ratio
     * @return Money
     */
    public function sumPercentage(int|float $ratio): Money
    {
        return Money::from(
            amount: $this->amount + ($this->amount / 100 * $ratio),
            currency: $this->currency
        );
    }

    /**
     * @param int|float $ratio
     * @return Money
     */
    public function minusPercentage(int|float $ratio): Money
    {
        return Money::from(
            amount: $this->amount - ($this->amount / 100 * $ratio),
            currency: $this->currency
        );
    }

    /**
     * @param Money $value
     * @return int|float
     */
    public function percentageRatio(Money $value): int|float
    {
        return $value->getAmount() / $this->amount * 100;
    }
}
