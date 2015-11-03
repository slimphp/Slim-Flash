<?php
namespace Slim\Flash;

use Twig_Extension;

/**
 * Twig extension to render a flash message within a twig template
 *
 * @package Slim\Flash
 * @author  Nigel Greenway <nigel_greenway@me.com>
 */
class TwigExtension extends Twig_Extension
{
    /**
     * @var Messages
     */
    private $messages;

    /**
     * @param Messages $messages
     */
    public function __construct(
        Messages $messages
    ) {
        $this->messages = $messages;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'slim-flash';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('get_message', [$this, 'getMessage']),
            new \Twig_SimpleFunction('get_messages', [$this, 'getMessages']),
        ];
    }

    /**
     * Get a single message
     *
     * @param string $key
     *
     * @throws MessageKeyContainsAnArrayException
     *
     * @return string
     */
    public function getMessage($key)
    {
        $message = $this->messages->getMessage($key);

        if (is_string($message) === false) {
            throw new MessageKeyContainsAnArrayException($key);
        }

        return $message;
    }

    /**
     * Return an array of messages. Pass an optional key if a specific
     * collection are required
     *
     * @param string|null $key
     *
     * @return array
     */
    public function getMessages($key = null)
    {
        if ($key === null) {
            return $this->messages->getMessages();
        }

        return $this->messages->getMessage($key);
    }
}