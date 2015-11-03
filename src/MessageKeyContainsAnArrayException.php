<?php
namespace Slim\Flash;

use UnexpectedValueException;

/**
 * Exception for when a message key contains an array instead of a single
 * string
 *
 * @package Slim\Flash
 * @author  Nigel Greenway <nigel_greenway@me.com>
 */
final class MessageKeyContainsAnArrayException extends UnexpectedValueException
{
    /**
     * @param string $key
     */
    public function __construct($key)
    {
        parent::__construct(
            sprintf(
                "The message key [%s] contains an array and not a string.\nConsider using `get_messages()` instead.",
                $key
            )
        );
    }
}