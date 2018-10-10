<?php

namespace Yang\Configuration\Traits;

use Yang\Configuration\Config;
use Yang\Core\Traits\Injection;

trait Configuration
{
    use Injection;

    public function __inject()
    {
        do {
            if (empty($this->config)) {
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
