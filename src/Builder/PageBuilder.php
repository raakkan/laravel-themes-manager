<?php

namespace Raakkan\ThemesManager\Builder;
use Raakkan\ThemesManager\Support\Traits\HasName;
use Raakkan\ThemesManager\Builder\Traits\HasFooter;
use Raakkan\ThemesManager\Builder\Traits\HasHeader;
use Raakkan\ThemesManager\Builder\Traits\HasSidebar;
use Raakkan\ThemesManager\Builder\Traits\HasHeroSection;
use Raakkan\ThemesManager\Builder\Traits\HasCallToAction;

class PageBuilder
{
    use HasName;
    use HasHeader;
    use HasFooter;
    use HasSidebar;
    use HasHeroSection;
    use HasCallToAction;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make(string $name): self
    {
        return new static($name);
    }
}
