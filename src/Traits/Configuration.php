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
        do {
            if (!$this->config) {
                break;
            }

            $config = [];
            foreach ($this->config as $item => $map) {
                $map || $map = $item;

                $config[$map] = Config::get($item);
            }

            $this->config = $config;
        } while (false);

        $this->__injected = true;
    }
}