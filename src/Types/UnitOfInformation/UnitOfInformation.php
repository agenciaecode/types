<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfInformation;

use Ecode\Types\Numeric;

abstract class UnitOfInformation extends Numeric
{
    /**
     * @param bool $abbreviated
     * @param int $maxDecimalPlaces
     * @return string
     */
    public function getHumansFormat(bool $abbreviated = true, int $maxDecimalPlaces = 2): string
    {
        $handledValue = $this->handleValue($this->value, $maxDecimalPlaces);

        if ($abbreviated) {
            return sprintf('%s %s', $handledValue, $this->getSymbol());
        }

        if ($handledValue == 1) {
            return sprintf('%s %s', $handledValue, strtolower($this->getName()));
        }

        return sprintf('%s %s', $handledValue, strtolower($this->getPlural()));
    }

    /**
     * @param float|int $value
     * @param int $maxDecimalPlaces
     * @return float
     */
    public static function handleValue(float|int $value, int $maxDecimalPlaces): float
    {
        return (float)number_format($value, $maxDecimalPlaces, '.', '');
    }

    /**
     * @return string
     */
    abstract public static function getSymbol(): string;

    /**
     * @return string
     */
    abstract public static function getName(): string;

    /**
     * @return string
     */
    abstract public static function getPlural(): string;
}
