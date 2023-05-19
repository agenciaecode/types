<?php declare(strict_types=1);

namespace Ecode\Types;

interface TypeInterface
{
    public function clone(): static;
}
