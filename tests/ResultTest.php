<?php

namespace Jungi\Core\Tests;

use Jungi\Core\Result;
use PHPUnit\Framework\TestCase;

/**
 * @author Piotr Kugla <piku235@gmail.com>
 */
class ResultTest extends TestCase
{
    public function testOkResult(): void
    {
        $result = Result::Ok(123);

        $this->assertTrue($result->isOk());
        $this->assertFalse($result->isErr());
        $this->assertEquals(123, $result->unwrap());
        $this->assertEquals(123, $result->unwrapOr(null));
    }

    public function testErrResult(): void
    {
        $result = Result::Err(123);

        $this->assertFalse($result->isOk());
        $this->assertTrue($result->isErr());
        $this->assertNull($result->unwrapOr(null));
        $this->assertEquals(123, $result->unwrapErr());
    }

    public function testThatOkResultFailsOnUnwrapErr(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Called on an "Ok" value.');

        $result = Result::Ok(123);
        $result->unwrapErr();
    }

    public function testThatErrResultFailsOnUnwrap(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Called on an "Err" value.');

        $result = Result::Err(123);
        $result->unwrap();
    }

    public function testResultAsOk(): void
    {
        $result = Result::Ok(123);
        $option = $result->asOk();

        $this->assertTrue($option->isSome());
        $this->assertEquals(123, $option->unwrap());

        $result = Result::Err(123);
        $option = $result->asOk();

        $this->assertTrue($option->isNone());
    }

    public function testResultAsErr(): void
    {
        $result = Result::Ok(123);
        $option = $result->asErr();

        $this->assertTrue($option->isNone());

        $result = Result::Err(123);
        $option = $result->asErr();

        $this->assertTrue($option->isSome());
        $this->assertEquals(123, $option->unwrap());
    }
}
