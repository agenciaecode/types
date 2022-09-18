<?php declare(strict_types=1);

namespace Mkioschi\ValueObjects\UnitOfInformation;

interface UnitOfInformationContract
{
    public function getHumansFormat(bool $abbreviated = true): string;
}
