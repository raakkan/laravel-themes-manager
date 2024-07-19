<?php

declare(strict_types=1);

namespace Raakkan\ThemesManager\Events;

use Raakkan\ThemesManager\Theme;

class ThemeEnabled
{
    public Theme $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }
}
