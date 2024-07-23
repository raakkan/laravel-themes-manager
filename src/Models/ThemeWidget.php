<?php

namespace Raakkan\ThemesManager\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeWidget extends Model
{
    protected $fillable = ['widget_id', 'name', 'settings', 'source', 'order', 'theme_widget_location_id'];

    protected $casts = [
        'settings' => 'json',
        'order' => 'integer',
    ];

    public function locations()
    {
        return $this->belongsTo(ThemeWidgetLocation::class, 'theme_widget_location_id');
    }

    public function deleteAndAdjustOrder()
    {
        $location = $this->locations;
        $widgetsToUpdate = $location->widgets()->where('order', '>', $this->order)->get();

        $this->delete();
        
        foreach ($widgetsToUpdate as $widget) {
            $widget->order--;
            $widget->save();
        }
    }

    public function getTable(): string
    {
        return config('themes-manager.widgets.database_table_name', 'theme_widgets');
    }
}
