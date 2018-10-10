<?php

namespace Yang\Configuration;

use Dotenv\Dotenv;
use Yang\Configuration\Providers\Environment as Provider;

/**
 * Class Environment
 * @package Yang\Configuration
 */
final class Environment
{
    /**
     * @var Provider
     */
    protected static $provider;

    /**
     * @param array $scanDirectories
     */
    public static function init(array $scanDirectories)
    {
        foreach ($scanDirectories as $directory) {
            (new Dotenv($directory))->safeLoad();
        }

        self::$provider = new Provider();
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return self::getProvider()->get($key, $default);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public static function set($key, $value)
    {
        return self::getProvider()->set($key, $value);
    }

    /**
     * @return Provider
     */
    protected static function getProvider()
    {
        return self::$provider ?: self::$provider = new Provider();
    }
}
