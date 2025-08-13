<?php

declare(strict_types=1);

namespace Flow\Bridge\Monolog\Http;

use Flow\Bridge\Monolog\Http\Config\{RequestConfig, ResponseConfig};

final class Config
{
    public function __construct(public ?RequestConfig $request = null, public ?ResponseConfig $response = null)
    {
        $this->request = $request ?? new RequestConfig();
        $this->response = $response ?? new ResponseConfig();
    }
}
