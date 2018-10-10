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
        $config = Config::get('injection.' . __CLASS__, []);
        foreach ($config as $key => $value) {
            $value && '&' === $value{0} && $value = Config::get(substr($value, 1));
            $this->config[$key] = $value;
        }

        $this->__injected = true;
    }
}
