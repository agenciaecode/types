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
    public readonly array $value;

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

        if (!is_array($parsedValue) || json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidTypeHttpException(sprintf('\'%s\' is a invalid json string.', $value));
        }

        return new static($parsedValue);
    }

    /**
     * @param ?string $value
     * @return ?static
     * @throws InvalidTypeHttpException
     */
    public static function innFromJson(?string $value): ?static
    {
        if (is_null($value)) {
            return null;
        }

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
        return $this->toJson();
    }

    /**
     * @param self $value
     * @return bool
     */
    public function equals(self $value): bool
    {
        return $this->value === $value->value;
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
     * @return int
     */
    public function count(): int
    {
        return count($this->value);
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

    /**
     * @param array $array
     * @return array
     */
    public static function trimNulls(array $array): array
    {
        foreach ($array as $value) {
            if (!is_null($value)) {
                $newArray[] = $value;
            }
        }

        return $newArray ?? [];
    }

    /**
     * @param array $array
     * @param string $keyName
     * @param string $valueName
     * @return array
     */
    public static function toKeyValue(array $array, string $keyName = 'key', string $valueName = 'value'): array
    {
        foreach ($array as $key => $value) {
            $keyValueArr[] = [
                $keyName => $key,
                $valueName => $value,
            ];
        }

        return $keyValueArr ?? [];
    }

    /**
     * @return bool
     */
    public function isSequential(): bool
    {
        return self::isSequentialArray($this->value);
    }

    /**
     * @return bool
     */
    public function isAssociative(): bool
    {
        return self::isAssociativeArray($this->value);
    }

    /**
     * @param array $array
     * @return bool
     */
    public static function isSequentialArray(array $array): bool
    {
        return array_values($array) === $array;
    }

    /**
     * @param array $array
     * @return bool
     */
    public static function isAssociativeArray(array $array): bool
    {
        return array_values($array) !== $array;
    }
}
