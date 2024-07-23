<?php

namespace Raakkan\ThemesManager\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeWidgetLocation extends Model
{
    protected $fillable = [
        'name',
        'label',
        'source',
    ];

    public function widgets()
    {
        return $this->hasMany(ThemeWidget::class, 'theme_widget_location_id');
    }

    public function getTable(): string
    {
        return config('themes-manager.widgets.location_database_table_name', 'theme_widget_locations');
    }
}
