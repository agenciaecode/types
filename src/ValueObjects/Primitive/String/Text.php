<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\Primitive\String;

use Mkioschi\Exceptions\Http\InvalidValueHttpException;

class Text extends Str
{
    /**
     * @param string $value
     * @throws InvalidValueHttpException
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}
