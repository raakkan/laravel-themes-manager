<?php

namespace Raakkan\ThemesManager\Builder\Traits;

trait HasHeroSection
{
    protected $heroSection = false;
    
    public function heroSection(): self
    {
        $this->heroSection = true;
        return $this;
    }
    
    public function hasHeroSection(): bool
    {
        return $this->heroSection;
    }
}

