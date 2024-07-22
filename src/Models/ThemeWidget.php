<?php

namespace Raakkan\ThemesManager\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeWidget extends Model
{
    protected $fillable = ['name', 'location','settings', 'source'];

    protected $casts = [
        'settings' => 'json',
    ];
}