<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfMeasurement;

use Mkioschi\Types\Numeric;

abstract class UnitOfMeasurement extends Numeric
{
    /**
     * @param bool $abbreviated
     * @param int $decimalPlaces
     * @return string
     */
    public function getHumansFormat(bool $abbreviated = true, int $decimalPlaces = 2): string
    {
        $formattedValue = is_float($this->value) ? number_format($this->value, $decimalPlaces, '.', '') : $this->value;
        if ($abbreviated) return sprintf('%s %s', $formattedValue, $this->getSymbol());
        if ($formattedValue === 1) return sprintf('%s %s', $formattedValue, strtolower($this->getName()));
        return sprintf('%s %s', $formattedValue, strtolower($this->getPlural()));
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
