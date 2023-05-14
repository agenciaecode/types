<?php declare(strict_types=1);

namespace Ecode\Types\Misc;

use Ecode\Enums\Currency;
use Ecode\Enums\Locale;
use Exception;
use NumberFormatter;

final class Money
{
    /** @var float */
    public readonly float $amount;

    /** @var Currency */
    public readonly Currency $currency;

    /**
     * @param float $amount
     * @param Currency $currency
     */
    private function __construct(float $amount, Currency $currency)
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
     * @param float $amount
     * @param Currency $currency
     * @return Money
     */
    public static function from(float $amount, Currency $currency): Money
    {
        return new Money($amount, $currency);
    }

    /**
     * @param ?float $amount
     * @param ?Currency $currency
     * @return ?Money
     */
    public static function innFrom(?float $amount, ?Currency $currency): ?Money
    {
        if (is_null($amount) || is_null($currency)) {
            return null;
        }

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
        $formattedString = $formatter->formatCurrency($this->amount, $this->currency->value);
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
    public static function currenciesAreTheSame(Currency ...$currencies): bool
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
        $this->validateCurrencies($value->currency);
        $result = $this->amount + $value->amount;
        return Money::from($result, $this->currency);
    }

    /**
     * @param Money $value
     * @return Money
     * @throws Exception
     */
    public function minus(Money $value): Money
    {
        $this->validateCurrencies($value->currency);
        $result = $this->amount - $value->amount;
        return Money::from($result, $this->currency);
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function lessThan(Money $value): bool
    {
        $this->validateCurrencies($value->currency);
        return $this->amount < $value->amount;
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function lessThanOrEqualTo(Money $value): bool
    {
        $this->validateCurrencies($value->currency);
        return $this->amount <= $value->amount;
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function greaterThan(Money $value): bool
    {
        $this->validateCurrencies($value->currency);
        return $this->amount > $value->amount;
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function greaterThanOrEqualTo(Money $value): bool
    {
        $this->validateCurrencies($value->currency);
        return $this->amount >= $value->amount;
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function equalTo(Money $value): bool
    {
        $this->validateCurrencies($value->currency);
        return $this->amount === $value->amount;
    }

    /**
     * @param Money $value
     * @return bool
     * @throws Exception
     */
    public function notEqualTo(Money $value): bool
    {
        $this->validateCurrencies($value->currency);
        return $this->amount !== $value->amount;
    }

    /**
     * @param Money $minValue
     * @param Money $maxValue
     * @return bool
     * @throws Exception
     */
    public function between(Money $minValue, Money $maxValue): bool
    {
        $this->validateCurrencies($minValue->currency, $maxValue->currency);
        return $this->amount > $minValue->amount && $this->amount < $maxValue->amount;
    }

    /**
     * @param Money $minValue
     * @param Money $maxValue
     * @return bool
     * @throws Exception
     */
    public function betweenOrEqualThen(Money $minValue, Money $maxValue): bool
    {
        $this->validateCurrencies($minValue->currency, $maxValue->currency);
        return $this->amount >= $minValue->amount && $this->amount <= $maxValue->amount;
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
            $currencies[] = $value->currency;
            $sum += $value->amount;
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
        return $value->amount / $this->amount * 100;
    }

    /**
     * @param float $amount
     * @return float
     */
    public static function roundAmount(float $amount): float
    {
        return round(num: $amount, precision: 2, mode: PHP_ROUND_HALF_UP);
    }

    /**
     * @return float
     */
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

    public function clone(): self
    {
        return new Money($this->amount, $this->currency);
    }
}
