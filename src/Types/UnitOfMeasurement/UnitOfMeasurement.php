<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement;

use Ecode\Types\Numeric;

abstract class UnitOfMeasurement extends Numeric
{
    /**
     * @param bool $abbreviated
     * @param int $maxDecimalPlaces
     * @return string
     */
    public function getHumansFormat(bool $abbreviated = true, int $maxDecimalPlaces = 2): string
    {
        $handledValue = (float)self::numberFormat($this->value, $maxDecimalPlaces);

        if ($abbreviated) {
            return sprintf('%s %s', $handledValue, $this->getSymbol());
        }

        if ($handledValue == 1) {
            return sprintf('%s %s', $handledValue, strtolower($this->getName()));
        }

        return sprintf('%s %s', $handledValue, strtolower($this->getPlural()));
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
