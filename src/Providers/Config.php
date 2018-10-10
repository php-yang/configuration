<?php

namespace Yang\Configuration\Providers;

use ArrayAccess;
use Countable;
use Iterator;
use JsonSerializable;
use Serializable;
use Yang\Core\Traits\ArrayObject;

/**
 * Class Config
 * @package Yang\Configuration\Providers
 */
class Config implements ArrayAccess, Serializable, Countable, JsonSerializable, Iterator
{
    use ArrayObject;

    /**
     * @var array
     */
    protected $cached = [];

    /**
     * @var string[]
     */
    protected $scanDirectories = [];

    /**
     * Config constructor.
     * @param array $configDirectories
     */
    public function __construct(array $configDirectories)
    {
        foreach ($configDirectories as $directory) {
            if (is_dir($directory)) {
                $this->scanDirectories[] = $directory;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function get($key, $default = null)
    {
        if (isset($this->cached[$key])) {
            return $this->cached[$key];
        }

        list($idx) = $sections = explode('.', $key);
        if (!isset($this->data[$idx])) {
            $this->load($idx);
        }

        if (0 === $count = count($sections) - 1) {
            return $this->cached[$idx] = $this->data[$idx];
        }

        $tmp = $this->data;
        for ($i = 0; $i < $count; $i++) {
            if (!is_array($tmp = $tmp[$sections[$i]])) {
                return $this->cached[$key] = $default;
            }
        }

        return $this->cached[$key] = isset($tmp[$sections[$count]]) ? $tmp[$sections[$count]] : $default;
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        return $this->cached[$key] = $value;
    }

    public function __destruct()
    {
        unset($this->data, $this->cached, $this->scanDirectories);
    }

    /**
     * @param string $name
     */
    protected function load($name)
    {
        $this->data[$name] = [];

        foreach ($this->scanDirectories as $directory) {
            $file = $directory . '/' . $name . '.php';
            if (!is_file($file)) {
                continue;
            }

            if (!is_array($array = include($file))) {
                continue;
            }

            $this->data[$name] = array_replace_recursive($this->data[$name], $array);
        }
    }
}
