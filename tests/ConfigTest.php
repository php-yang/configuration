<?php

namespace Yang\Configuration\Tests;

use PHPUnit\Framework\TestCase;
use Yang\Configuration\Config;

/**
 * Class ConfigTest
 * @package Yang\Configuration\Tests
 */
class ConfigTest extends TestCase
{
    public function testEnv()
    {
        Config::init([__DIR__ . '/resources/config']);

        $this->assertEquals(Config::get('test.name'), 'neo');

        Config::set('test.name', 'whatever');
        $this->assertEquals(Config::get('test.name'), 'whatever');
    }
}
