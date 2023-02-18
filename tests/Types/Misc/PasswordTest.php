<?php declare(strict_types=1);

namespace Ecode\Tests\Types\Misc;

use Ecode\Types\Misc\Password;
use Exception;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_create_a_valid_password()
    {
        $this->assertInstanceOf(Password::class, Password::from('P@ssw0rd'));
        $this->assertEquals('P@ssw0rd', Password::from('P@ssw0rd')->value);
        $this->assertEquals(null, Password::tryFrom('123123'));
    }
}