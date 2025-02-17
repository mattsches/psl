<?php

declare(strict_types=1);

namespace Psl\Tests\Unit\Type;

use Psl\Math;
use Psl\Type;

final class I16TypeTest extends TypeTest
{
    public function getType(): Type\TypeInterface
    {
        return Type\i16();
    }

    public function getValidCoercions(): iterable
    {
        yield [123, 123];
        yield [0, 0];
        yield ['0', 0];
        yield ['123', 123];
        yield [$this->stringable('123'), 123];
        yield ['7', 7];
        yield ['07', 7];
        yield ['007', 7];
        yield ['-107', -107];
        yield ['000', 0];
        yield [1.0, 1];
        yield [$this->stringable((string) Math\INT16_MIN), Math\INT16_MIN];
        yield [$this->stringable((string) Math\INT16_MAX), Math\INT16_MAX];
        yield [$this->stringable('-321'), -321];
        yield ['-321', -321];
        yield [-321, -321];
    }

    public function getInvalidCoercions(): iterable
    {
        yield [1.23];
        yield ['1.23'];
        yield ['1e123'];
        yield [''];
        yield [[]];
        yield [[123]];
        yield [null];
        yield [false];
        yield [$this->stringable('1.23')];
        yield [$this->stringable('-007')];
        yield ['-007'];
        yield ['9223372036854775808'];
        yield [$this->stringable('9223372036854775808')];
        yield ['-9223372036854775809'];
        yield [$this->stringable('-9223372036854775809')];
        yield ['0xFF'];
        yield [''];
        yield [$this->stringable((string) Math\INT32_MIN)];
        yield [$this->stringable((string) Math\INT32_MAX)];
        yield [$this->stringable((string) Math\INT64_MAX)];
        yield [(string) Math\INT64_MAX];
        yield [Math\INT64_MAX];
    }

    public function getToStringExamples(): iterable
    {
        yield [$this->getType(), 'i16'];
    }

    public function testItIsAMemoizedType(): void
    {
        static::assertSame(Type\i16(), Type\i16());
    }
}
