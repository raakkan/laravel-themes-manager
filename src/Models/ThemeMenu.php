<?php

namespace Raakkan\ThemesManager\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeMenu extends Model
{
    protected $fillable = ['name', 'location', 'items', 'is_active'];

    protected $casts = [
        'items' => 'json',
        'is_active' => 'boolean',
    ];

    public function getTable(): string
    {
        return config('themes-manager.menus.database_table_name', 'theme_menus');
    }
}