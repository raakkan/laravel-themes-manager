<?php

namespace Raakkan\ThemesManager\Http\Middleware;

use Illuminate\Http\Request;
use Raakkan\ThemesManager\Models\ThemeSetting;

class DatabaseThemeLoader extends ThemeLoader
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, \Closure $next, ?string $theme = null)
    {
        $theme = ThemeSetting::getCurrentTheme();

        return parent::handle($request, $next, $theme);
    }
}