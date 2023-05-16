<?php declare(strict_types=1);

namespace Ecode\Types;

trait ErrorsTrait
{
    protected array $errors = [];

    protected function addError(string $error): void
    {
        $this->errors[] = $error;
    }

    protected function getErrors(): ?array
    {
        if (count($this->errors) === 0) {
            return null;
        }

        return $this->errors;
    }

    protected function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }
}