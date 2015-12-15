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

    // Test a string can be added to a message array for the next request
    public function testAddMessageFromAnIntegerForNextRequest()
    {
        $storage = ['slimFlash' => []];
        $flash   = new Messages($storage);

        $flash->addMessage('key', 46);
        $flash->addMessage('key', 48);

        $this->assertArrayHasKey('slimFlash', $storage);
        $this->assertEquals(['46', '48'], $storage['slimFlash']['key']);
    }

    // Test a string can be added to a message array for the next request
    public function testAddMessageFromStringForNextRequest()
    {
        $storage = ['slimFlash' => []];
        $flash   = new Messages($storage);

        $flash->addMessage('key', 'value');

        $this->assertArrayHasKey('slimFlash', $storage);
        $this->assertEquals(['value'], $storage['slimFlash']['key']);
    }

    // Test an array can be added to a message array for the next request
    public function testAddMessageFromArrayForNextRequest()
    {
        $storage = ['slimFlash' => []];
        $flash   = new Messages($storage);

        $formData = [
            'username'     => 'Scooby Doo',
            'emailAddress' => 'scooby@mysteryinc.org',
        ];

        $flash->addMessage('old', $formData);

        $this->assertArrayHasKey('slimFlash', $storage);
        $this->assertEquals($formData, $storage['slimFlash']['old']);
    }

    // Test an object can be added to a message array for the next request
    public function testAddMessageFromObjectForNextRequest()
    {
        $storage = ['slimFlash' => []];
        $flash   = new Messages($storage);

        $user = new \stdClass();
        $user->name         = 'Scooby Doo';
        $user->emailAddress = 'scooby@mysteryinc.org';

        $flash->addMessage('user', $user);

        $this->assertArrayHasKey('slimFlash', $storage);
        $this->assertInstanceOf(\stdClass::class, $storage['slimFlash']['user']);
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
        $flash->addMessage('Test', 'Test2');

        $this->assertArrayHasKey('slimFlash', $storage);
        $this->assertEquals(['Test', 'Test2'], $storage['slimFlash']['Test']);
    }
    
    //Test getting the message from the key
    public function testGetMessageFromKey()
    {
        $storage = ['slimFlash' => [ 'Test' => ['Test', 'Test2']]];
        $flash = new Messages($storage);

        $this->assertEquals(['Test', 'Test2'], $flash->getMessage('Test'));        
    }
}
