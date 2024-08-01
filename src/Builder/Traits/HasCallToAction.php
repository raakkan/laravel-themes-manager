<?php

namespace Raakkan\ThemesManager\Builder\Traits;

trait HasCallToAction
{
    protected $callToAction = false;
    
    public function callToAction(): self
    {
        $this->callToAction = true;
        return $this;
    }
    
    public function hasCallToAction(): bool
    {
        return $this->callToAction;
    }
}
