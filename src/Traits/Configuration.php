<?php

namespace Yang\Configuration\Traits;

use Yang\Configuration\Config;
use Yang\Core\Traits\Injection;

trait Configuration
{
    use Injection;

    /**
     * @var array
     */
    protected $config = [];

    public function __inject()
    {
        $this->config = Config::get('injection.' . __CLASS__, []);
        $this->__injected = true;
    }
}
