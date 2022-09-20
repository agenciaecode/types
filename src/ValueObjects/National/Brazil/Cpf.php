<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\National\Brazil;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\Primitive\String\Str;
use Mkioschi\ValueObjects\ValueObject;

class Cpf extends ValueObject
{
    /**
     * @param string $value
     * @throws InvalidValueHttpException
     */
    public function __construct(string $value)
    {
        if (!$this->isValid($value))
            throw new InvalidValueHttpException(sprintf('%s is an invalid CPF.', $value));

        $this->value = Str::extractNumbers($value);
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValid(string $value): bool
    {
        $cpf = Str::extractNumbers($value);

        if (strlen($cpf) != 11) return false;
        if (preg_match(pattern: '/(\d)\1{10}/', subject: $cpf)) return false;

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf[$c] != $d) return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getHumansFormat(): string
    {
        return sprintf(
            '%s.%s.%s-%s',
            substr($this->value, 0, 3),
            substr($this->value, 3, 3),
            substr($this->value, 6, 3),
            substr($this->value, -2)
        );
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
