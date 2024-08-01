<?php

namespace Raakkan\ThemesManager\Builder\Traits;

trait HasSidebar
{
    protected $sidebar = '';
    
    public function sidebar(string $sidebar): self
    {
        $this->sidebar = $sidebar;
        return $this;
    }

    public function getSidebar(): string
    {
        return $this->sidebar;
    }

    public function hasSidebar(): bool
    {
        return $this->sidebar !== '';
    }
}

