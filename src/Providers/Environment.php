<?php

namespace Yang\Configuration\Providers;

use ArrayAccess;
use Countable;
use Iterator;
use JsonSerializable;
use Serializable;
use Yang\Core\Traits\ArrayObject;

/**
 * Class Environment
 * @package Yang\Framework\Foundation
 */
class Environment implements ArrayAccess, Serializable, Countable, JsonSerializable, Iterator
{
    use ArrayObject;

    /**
     * Environment constructor.
     */
    public function __construct()
    {
        $this->data = $_ENV;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $value = isset($this->data[$key]) ? $this->data[$key] : $default;

        if (!is_string($value) || strlen($value) > 5) {
            return $value;
        }

        switch ($value) {
            case 'TRUE':    // through
            case 'True':    // through
            case 'true':
                return $this->set($key, true);
            case 'FALSE':   // through
            case 'False':   // through
            case 'false':
                return $this->set($key, false);
            case 'NULL':    // through
            case 'Null':    // through
            case 'null':
                return $this->set($key, null);
            default:
                return $value;
        }
    }
}
