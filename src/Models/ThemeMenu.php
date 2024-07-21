<?php

namespace Raakkan\ThemesManager\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeMenu extends Model
{
    protected $fillable = ['name', 'location','is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(ThemeMenuItem::class, 'menu_id');
    }

    public function getTable(): string
    {
        return config('themes-manager.menus.database_table_name', 'theme_menus');
    }
}