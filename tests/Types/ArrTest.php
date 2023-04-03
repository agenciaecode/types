<?php declare(strict_types=1);

namespace Ecode\Tests\Types;

use Ecode\Exceptions\Http\InvalidTypeHttpException;
use Ecode\Types\Arr;
use PHPUnit\Framework\TestCase;

class ArrTest extends TestCase
{
    public function test_should_be_able_to_create_a_valid_arr()
    {
        $this->assertInstanceOf(Arr::class, Arr::from(['host' => 'github.com']));
        $this->assertEquals(['host' => 'github.com'], Arr::from(['host' => 'github.com'])->value);
        $this->assertEquals('{"host":"github.com"}', (string)Arr::from(['host' => 'github.com']));
        $this->assertEquals(null, Arr::innFrom(null));
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function test_should_be_able_to_create_a_valid_arr_from_json_string()
    {
        $this->assertEquals(['host' => 'github.com'], Arr::fromJson('{"host":"github.com"}')->value);
        $this->assertEquals('{"host":"github.com"}', Arr::fromJson('{"host":"github.com"}')->toJson());
        $this->assertEquals(null, Arr::innFromJson(null));
        $this->assertEquals(true, Arr::isValidJsonString('{"host":"github.com"}'));
        $this->assertEquals(false, Arr::isValidJsonString('"host":"github.com"'));
    }

    public function test_should_be_able_to_count_arr()
    {
        $this->assertEquals(3, Arr::from(['GitHub', 'GitLab', 'Bitbucket'])->count());
    }

    public function test_should_be_able_to_iterate_arr()
    {
        $gitRepositoriesArr = ['GitHub', 'GitLab', 'Bitbucket'];
        $gitRepositories = Arr::from($gitRepositoriesArr);
        
        foreach ($gitRepositories as $gitRepository) {
            $this->assertEquals($gitRepositoriesArr[$gitRepositories->key()], $gitRepository);
        }
    }

    public function test_should_be_able_to_trim_nulls_positions()
    {
        $inputArray = ['GitHub', null, 'GitLab', 'Bitbucket'];
        $expectedArray = ['GitHub', 'GitLab', 'Bitbucket'];

        $this->assertEquals($expectedArray, Arr::trimNulls($inputArray));
    }

    public function test_should_be_able_to_transform_on_key_value_format()
    {
        $inputArray = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@email.com',
            'birthdate' => '1989-05-10'
        ];

        $expectedArray = [
            [
                'key' => 'first_name',
                'value' => 'John',
            ],
            [
                'key' => 'last_name',
                'value' => 'Doe',
            ],
            [
                'key' => 'email',
                'value' => 'johndoe@email.com',
            ],
            [
                'key' => 'birthdate',
                'value' => '1989-05-10',
            ]
        ];

        $this->assertEquals($expectedArray, Arr::toKeyValue($inputArray));
    }

    public function test_array_types()
    {
        $fruits = ['apple', 'orange', 'banana'];
        $this->assertEquals(true, Arr::isSequencialArray($fruits));
        $this->assertEquals(false, Arr::isAssociativeArray($fruits));

        $person = Arr::from(['name' => 'John Doe', 'email' => 'johndoe@email.com']);
        $this->assertEquals(false, $person->isSequencial());
        $this->assertEquals(true, $person->isAssociative());
    }
}
