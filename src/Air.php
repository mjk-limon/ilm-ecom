<?php

namespace Ilm\Ecom;

class Air extends IlmComm
{
    public function get(string $path)
    {
        return $this->http->get($path)->body();
    }

    public function post(string $path, array $payload)
    {
        return $this->http->post($path, $payload)->body();
    }

    public function put(string $path, array $payload)
    {
        return $this->http->put($path, $payload)->body();
    }

    public function delete(string $path)
    {
        return $this->http->delete($path)->body();
    }
}
