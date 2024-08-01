<?php

namespace Raakkan\ThemesManager\Builder\Traits;

trait HasHeader
{
    protected $header = false;
    
    public function header(): self
    {
        $this->header = true;
        return $this;
    }

    public function hasHeader(): bool
    {
        return $this->header;
    }
}

