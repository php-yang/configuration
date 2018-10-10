<?php

namespace Yang\Configuration\Tests;

use PHPUnit\Framework\TestCase;
use Yang\Configuration\Server;

/**
 * Class ServerTest
 * @package Yang\Configuration\Tests
 */
class ServerTest extends TestCase
{
    public function testEnv()
    {
        $this->assertNotNull(Server::get('PATH'));
        $this->assertNotNull(Server::get('HOME'));

        Server::set('TEST_USER', 'neo');
        $this->assertEquals(Server::get('TEST_USER'), 'neo');
    }
}
