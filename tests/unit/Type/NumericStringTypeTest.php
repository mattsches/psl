<?php

declare(strict_types=1);

namespace Psl\Tests\Unit\Type;

use Psl\Type;

/**
 * @extends TypeTest<numeric-string>
 */
final class NumericStringTypeTest extends TypeTest
{
    /**
     * @return Type\Type<numeric-string>
     */
    public function getType(): Type\TypeInterface
    {
        return Type\numeric_string();
    }

    public function getValidCoercions(): iterable
    {
        yield [123, '123'];
        yield [0, '0'];
        yield [1.0, '1'];
        yield [1.23, '1.23'];
        yield ['0', '0'];
        yield ['123', '123'];
        yield ['1e23', '1e23'];
        yield [$this->stringable('123'), '123'];
    }

    public function getInvalidCoercions(): iterable
    {
        yield [''];
        yield ['hello', 'hello'];
        yield [$this->stringable('hello'), 'hello'];
        yield [[]];
        yield [[1]];
        yield [Type\bool()];
        yield [null];
        yield [false];
        yield [true];
        yield [STDIN];
    }

    public function getToStringExamples(): iterable
    {
        yield [$this->getType(), 'numeric-string'];
    }

    public function testItIsAMemoizedType(): void
    {
        static::assertSame(Type\numeric_string(), Type\numeric_string());
    }
}
