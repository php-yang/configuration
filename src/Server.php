<?php

namespace Yang\Configuration;

use Yang\Configuration\Providers\Server as Provider;

/**
 * Class Server
 * @package Yang\Configuration
 */
class Server
{
    /**
     * @var Provider
     */
    protected static $provider;

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
     * @return array
     */
    public static function all()
    {
        return self::getProvider()->all();
    }

    /**
     * @return Provider
     */
    protected static function getProvider()
    {
        return self::$provider ?: self::$provider = new Provider();
    }
}
