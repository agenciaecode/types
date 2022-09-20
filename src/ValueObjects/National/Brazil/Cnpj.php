<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\National\Brazil;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;
use Mkioschi\ValueObjects\Primitive\String\Str;
use Mkioschi\ValueObjects\ValueObject;

class Cnpj extends ValueObject
{
    /**
     * @param string $value
     * @throws InvalidValueHttpException
     */
    public function __construct(string $value)
    {
        if (!$this->isValid($value))
            throw new InvalidValueHttpException(sprintf('%s is an invalid CNPJ.', $value));

        $this->value = Str::extractNumbers($value);
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValid(string $value): bool
    {
        $cnpj = Str::extractNumbers($value);

        if (strlen($cnpj) !== 14) return false;
        if (preg_match(pattern: '/(\d)\1{13}/', subject: $cnpj)) return false;

        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $rest = $sum % 11;
        if ($cnpj[12] != ($rest < 2 ? 0 : 11 - $rest)) return false;

        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $rest = $sum % 11;
        if ($cnpj[13] != ($rest < 2 ? 0 : 11 - $rest)) return false;

        return true;
    }

    /**
     * @return string
     */
    public function getHumansFormat(): string
    {
        return sprintf(
            '%s.%s.%s/%s-%s',
            substr($this->value, 0, 2),
            substr($this->value, 2, 3),
            substr($this->value, 5, 3),
            substr($this->value, 8, 4),
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
