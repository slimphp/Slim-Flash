<?php
namespace Slim\Flash\Tests;

use Slim\Flash\Messages;
use Slim\Flash\TwigExtension;
use Slim\Views\Twig;

class TwigExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Messages
     */
    private $flash;

    /**
     * @var Twig
     */
    private $twig;

    public function setUp()
    {
        $storage = [
            'slimFlash' => [
                'error' => 'This is an error',
                'success' => [
                    'This is the first success',
                    'This is the second success',
                ],
            ],
        ];
        $this->flash = new Messages($storage);
        $this->twig  = new Twig(__DIR__.'/fixtures/templates');

        $this->twig->addExtension(
            new TwigExtension($this->flash)
        );
    }

    public function test_get_message_returns_valid_string()
    {
        $this->assertEquals(
            'This is an error',
            $this->twig->fetch('error-test.twig', [])
        );
    }

    public function test_get_messages_with_success_key_returns_an_array()
    {
        $this->assertEquals(
            '["This is the first success","This is the second success"]',
             $this->twig->fetch('multi-success-test.twig', [])
        );
    }

    /**
     * @expectedException \Twig_Error_Runtime
     */
    public function test_get_message_throws_SomethingException_as_it_contains_an_array()
    {
        $this->twig->fetch('array-exception-test.twig', []);
    }

    public function test_get_message_with_no_key_returns_a_multi_dimensional_array()
    {
        $this->assertEquals(
            '{"error":"This is an error","success":["This is the first success","This is the second success"]}',
            $this->twig->fetch('all-messages-test.twig', [])
        );
    }
}