<?php
namespace Slim\Flash\Test;

use Slim\Flash\MessageKeyContainsAnArrayException;

final class MessageKeyContainsAnArrayExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function test_exception_extends_UnexpectedValueException()
    {
        $this->assertInstanceOf(
            '\UnexpectedValueException',
            new MessageKeyContainsAnArrayException('some_key')
        );
    }

    public function test_exception_contains_correct_key_in_message()
    {
        $this->assertEquals(
            "The message key [test_key] contains an array and not a string.\nConsider using `get_messages()` instead.",
            (new MessageKeyContainsAnArrayException('test_key'))->getMessage()
        );
    }
}