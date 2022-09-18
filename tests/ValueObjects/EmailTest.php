<?php declare(strict_types=1);

namespace Mkioschi\Tests\ValueObjects;

use Mkioschi\ValueObjects\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_email()
    {
        $email = new Email('email@domain.com');
        $this->assertInstanceOf(Email::class, $email);
        $this->assertEquals('email@domain.com', $email->getValue());

        $email = new Email('EMAIL@DOMAIN.COM');
        $this->assertEquals('email@domain.com', (string)$email);
    }

    public function test_email_hidden_format()
    {
        $email = new Email('email@domain.com');
        $this->assertEquals('e***l@d********m', $email->getHiddenFormat());

        $email = new Email('me@domain.com');
        $this->assertEquals('m*@d********m', $email->getHiddenFormat());

        $email = new Email('me@mydomain.com');
        $this->assertEquals('m*@my*********m', $email->getHiddenFormat());

        $email = new Email('myname@mydomain.com');
        $this->assertEquals('m****e@my*********m', $email->getHiddenFormat());

        $email = new Email('myname@mydomain.com');
        $this->assertEquals('m####e@my#########m', $email->getHiddenFormat('#'));
    }
}