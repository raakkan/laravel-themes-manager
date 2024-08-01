<?php

namespace Raakkan\ThemesManager\Builder\Traits;

trait HasFooter
{
    protected $footer = false;
    
    public function footer(): self
    {
        $this->footer = true;
        return $this;
    }

    public function hasFooter(): bool
    {
        return $this->footer;
    }
}
