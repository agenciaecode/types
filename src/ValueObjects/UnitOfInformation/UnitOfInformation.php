<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\UnitOfInformation;

use Mkioschi\ValueObjects\ValueObject;

abstract class UnitOfInformation extends ValueObject implements UnitOfInformationContract
{
    /**
     * @param bool $abbreviated
     * @param int $decimalPlaces
     * @return string
     */
    public function getHumansFormat(bool $abbreviated = true, int $decimalPlaces = 2): string
    {
        $formattedValue = is_float($this->value) ? number_format($this->value, $decimalPlaces, '.', '') : $this->value;
        if ($abbreviated) return sprintf('%s %s', $formattedValue, static::SYMBOL);
        if ($formattedValue === 1) return sprintf('%s %s', $formattedValue, static::NAME);
        return sprintf('%s %s', $formattedValue, static::PLURAL);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getValue();
    }
}
