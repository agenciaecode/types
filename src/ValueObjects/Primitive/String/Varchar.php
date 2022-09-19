<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\Primitive\String;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;

class Varchar extends Str
{
    /**
     * @param string $value
     * @throws InvalidValueHttpException
     */
    public function __construct(string $value)
    {
        if (!$this->isValid($value, 255, true))
            throw new InvalidValueHttpException(sprintf('%s is an invalid Varchar.', $value));

        parent::__construct($value);
    }
}
