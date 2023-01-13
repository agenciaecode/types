<?php declare(strict_types=1);

namespace Ecode\Types;

trait ErrorsTrait
{
    /**
     * @var string[]
     */
    protected array $errors = [];

    /**
     * @param string $error
     * @return void
     */
    protected function addError(string $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * @return ?string[]
     */
    protected function getErrors(): ?array
    {
        if (count($this->errors) === 0) return null;
        return $this->errors;
    }

    /**
     * @return bool
     */
    protected function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }
}