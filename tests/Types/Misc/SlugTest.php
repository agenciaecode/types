<?php declare(strict_types=1);

namespace Ecode\Tests\Types\Misc;

use Ecode\Types\Misc\Slug;
use Exception;
use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_should_be_able_to_create_a_valid_slug()
    {
        $this->assertInstanceOf(Slug::class, Slug::from('some-string'));
        $this->assertEquals('some-string', Slug::from('some-string')->getValue());
        $this->assertEquals('some-string', Slug::fromText('Some string')->getValue());
        $this->assertEquals(false, Slug::isValid(' '));
        $this->assertEquals(true, Slug::isValid('a'));
        $this->assertEquals(false, Slug::isValid(''));
    }
}