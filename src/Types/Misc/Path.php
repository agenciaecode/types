<?php declare(strict_types=1);

namespace Mkioschi\Types\Misc;

use Exception;
use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Str;

final class Path extends Str
{
    /**
     * @param string $value
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value))
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Path type.', $value));
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) return false;
        return !preg_match("/[^a-zA-ZÀ-ú \/).(+_-]/", $value);
    }

    /**
     * @param ...$paths
     * @return $this
     * @throws Exception
     */
    public function join(...$paths): Path
    {
        if (count($paths) === 0) throw new Exception('Join method needs at least one path.');

        foreach($paths as $path) {
            if (!self::isValid($path)) throw new Exception(sprintf('%s is a invalid path.', $path));
            $this->mergePath($path);
        }

        return $this;
    }

    /**
     * @param string $path
     * @return void
     */
    private function mergePath(string $path): void
    {
        $this->value .= str_ends_with($this->value, '/') ? $path : sprintf('/%s', $path);
    }

    /**
     * @return $this
     */
    public function back(): Path {
        $this->value .= str_ends_with($this->value, '/') ? '../' : '/../';
        return $this;
    }

    /**
     * @return bool
     */
    public function isAbsolutePath(): bool {
        return str_starts_with($this->value, '/');
    }

    /**
     * @return bool
     */
    public function isRelativePath(): bool {
        return !str_starts_with($this->value, '/');
    }

    /**
     * @return string
     */
    public function getAsAbsolutePath(): string
    {
        if (str_starts_with($this->value, '/')) return $this->value;
        return sprintf('/%s', $this->value);
    }

    /**
     * @return string
     */
    public function getAsRelativePath(): string
    {
        if (!str_starts_with($this->value, '/')) return $this->value;
        return substr($this->value, 1);
    }
}
