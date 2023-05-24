<?php declare(strict_types=1);

namespace Ecode\Tests\Types\UnitOfMeasurement\Information;

use Ecode\Types\UnitOfMeasurement\Information\Byte;
use Ecode\Types\UnitOfMeasurement\Information\Gigabyte;
use Ecode\Types\UnitOfMeasurement\Information\Kilobyte;
use Ecode\Types\UnitOfMeasurement\Information\Megabyte;
use PHPUnit\Framework\TestCase;

class InformationTest extends TestCase
{
    public function test_should_be_able_to_calculate_math_operations()
    {
        $this->assertEquals(
            expected: 2048,
            actual: Byte::from(1024)->sum(1024)->value
        );

        $this->assertEquals(
            expected: 2048,
            actual: Byte::from(1024)->sum(Kilobyte::from(1))->value
        );

        $this->assertEquals(
            expected: 1049600,
            actual: Byte::from(1024)->sum(Megabyte::from(1))->value
        );

        $this->assertEquals(
            expected: 1073742848,
            actual: Byte::from(1024)->sum(Gigabyte::from(1))->value
        );
    }
}