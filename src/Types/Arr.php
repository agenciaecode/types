<?php declare(strict_types=1);

namespace Ecode\Types;

use Countable;
use Exception;
use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Iterator;

class Arr implements Countable, Iterator
{
    /**
     * @var array
     */
    protected array $value = [];

    /**
     * @var int
     */
    protected int $index;

    /**
     * @param array $value
     */
    protected function __construct(array $value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        return is_array($value);
    }

    /**
     * @param array $value
     * @return static
     */
    public static function from(array $value): static
    {
        return new static($value);
    }

    /**
     * @param array $value
     * @return ?static
     */
    public static function tryFrom(array $value): ?static
    {
        try {
            return new static($value);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @param ?array $value
     * @return ?static
     */
    public static function innFrom(?array $value): ?static
    {
        if (is_null($value)) return null;
        return new static($value);
    }

    /**
     * @param string $value
     * @return static
     * @throws InvalidTypeHttpException
     */
    public static function fromJson(string $value): static
    {
        $parsedValue = json_decode($value, true);
        if (!is_array($parsedValue) || json_last_error() !== JSON_ERROR_NONE)
            throw new InvalidTypeHttpException(sprintf('\'%s\' is a invalid json string.', $value));
        return new static($parsedValue);
    }

    /**
     * @param ?string $value
     * @return ?static
     * @throws InvalidTypeHttpException
     */
    public static function innFromJson(?string $value): ?static
    {
        if (is_null($value)) return null;
        return static::fromJson($value);
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->value);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return static::toJson();
    }

    /**
     * @return array
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * @param self $value
     * @return bool
     */
    public function equals(self $value): bool
    {
        return $this->getValue() === $value->getValue();
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValidJsonString(string $value): bool
    {
        return is_array(json_decode($value, true)) && json_last_error() === JSON_ERROR_NONE;
    }

    /**
     * @return static
     */
    public static function init(): static
    {
        return new static([]);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->value);
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function push(mixed $value): static
    {
        $this->value[] = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function current(): mixed
    {
        return $this->value[$this->index];
    }

    /**
     * @return void
     */
    public function next(): void
    {
        ++$this->index;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->index;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->value[$this->index]);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->index = 0;
    }
}
