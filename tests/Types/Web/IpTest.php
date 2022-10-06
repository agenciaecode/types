<?php declare(strict_types=1);

namespace Ecode\Tests\Types\Web;

use Ecode\Types\Web\Ip;
use PHPUnit\Framework\TestCase;

class IpTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_ip()
    {
        $this->assertInstanceOf(Ip::class, Ip::from('127.0.0.1'));
        $this->assertEquals('127.0.0.1', Ip::from('127.0.0.1')->getValue());
        $this->assertEquals('127.0.0.1', Ip::innFrom('127.0.0.1')->getValue());
        $this->assertEquals('127.0.0.1', Ip::tryFrom('127.0.0.1')->getValue());
        $this->assertEquals(true, Ip::tryFrom('127.0.0.1')->isV4());
        $this->assertEquals(false, Ip::tryFrom('2001:0db8:85a3:08d3:1319:8a2e:0370:7344')->isV4());
        $this->assertEquals(false, Ip::tryFrom('127.0.0.1')->isV6());
        $this->assertEquals(true, Ip::tryFrom('2001:0db8:85a3:08d3:1319:8a2e:0370:7344')->isV6());
        $this->assertEquals(null, Ip::innFrom(null));
        $this->assertEquals(null, Ip::tryFrom('https://github.com'));
    }
}