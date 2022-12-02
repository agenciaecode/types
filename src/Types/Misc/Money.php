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
}
