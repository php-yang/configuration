<?php

namespace Yang\Configuration;

use Yang\Configuration\Providers\Config as Provider;

/**
 * Class Config
 * @package Yang\Configuration
 */
final class Config
{
    /**
     * @var Provider
     */
    protected static $provider;

    /**
     * @param array $configDirectories
     */
    public static function init(array $configDirectories)
    {
        self::$provider = new Provider($configDirectories);
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
        return self::$provider ?: self::$provider = new Provider([]);
    }
}
