<?php declare(strict_types=1);

namespace Ecode\Types;

abstract class AbstractType implements TypeInterface
{
    public function clone(): static
    {
        return clone $this;
    }
}
