<?php
namespace Slim\Flash\Tests;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Flash\Messages;

class MessagesTest extends \PHPUnit_Framework_TestCase
{
    // Test get messages from previous request
    public function testGetMessagesFromPrevRequest()
    {
        $storage = ['slimFlash' => ['Test']];
        $flash = new Messages($storage);

        $this->assertEquals(['Test'], $flash->getMessages());
    }

    // Test get empty messages from previous request
    public function testGetEmptyMessagesFromPrevRequest()
    {
        $storage = [];
        $flash = new Messages($storage);

        $this->assertEquals([], $flash->getMessages());
    }

    // Test set messages for next request
    public function testSetMessagesForNextRequest()
    {
        $storage = [];
        $flash = new Messages($storage);
        $flash->addMessage('Test', 'Test');

        $this->assertArrayHasKey('slimFlash', $storage);
        $this->assertEquals('Test', $storage['slimFlash']['Test']);
    }
    
    //Test getting the message from the key
    public function testGetMessageFromKey()
    {
        $storage = [];
        $flash = new Messages($storage);
        $flash->addMessage('Test', 'Test');

        $this->assertEquals('Test', $flash->getMessage('Test'));        
    }
}
