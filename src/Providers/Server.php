<?php

namespace Yang\Configuration\Providers;

use ArrayAccess;
use Countable;
use Iterator;
use JsonSerializable;
use Serializable;
use Yang\Core\Traits\ArrayObject;

/**
 * Class Server
 * @package Yang\Configuration\Providers
 */
class Server implements ArrayAccess, Serializable, Countable, JsonSerializable, Iterator
{
    use ArrayObject;

    /**
     * Environment constructor.
     */
    public function __construct()
    {
        $this->data = $_SERVER;
    }
}
