<?php declare(strict_types=1);

namespace Ecode\Types\UnitOfMeasurement\Length;

use Ecode\Types\UnitOfMeasurement\UnitOfMeasurement;

abstract class Length extends UnitOfMeasurement
{
    abstract protected function normalize(float|int|self $value): float|int;

    public function sum(float|int|self $value): static
    {
        return new static(
            value: $this->value + $this->normalize($value)
        );
    }
}