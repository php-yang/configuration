<?php

namespace Yang\Configuration\Tests;

use PHPUnit\Framework\TestCase;
use Yang\Configuration\Environment;

/**
 * Class EnvironmentTest
 * @package Yang\Configuration\Tests
 */
class EnvironmentTest extends TestCase
{
    public function testEnv()
    {
        Environment::init([__DIR__ . '/resources']);

        $this->assertEquals(Environment::get('NAME'), 'neo');
        $this->assertEquals(Environment::get('MALE'), true);
        $this->assertEquals(Environment::get('WELCOME'), Environment::get('NAME') . ', welcome!');

        $this->assertNotEmpty(Environment::all());
    }
}
