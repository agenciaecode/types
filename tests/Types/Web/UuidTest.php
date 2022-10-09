<?php declare(strict_types=1);

namespace Ecode\Tests\Types\Web;

use Ecode\Types\Web\Uuid;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_uuid()
    {
        $this->assertInstanceOf(Uuid::class, Uuid::from('bd94a8b0-4ecf-4119-8c41-8b81ee6a7184'));
        $this->assertInstanceOf(Uuid::class, Uuid::generate());
        $this->assertInstanceOf(Uuid::class, Uuid::generateV4());
    }
}