<?php

namespace Ilm\Ecom;

class Air extends IlmComm
{
    public function get(string $path)
    {
        return $this->http->get($path)->body();
    }

    // public function 
}
