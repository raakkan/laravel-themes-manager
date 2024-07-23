<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Path to lookup theme
    |--------------------------------------------------------------------------
    |
    | The root path contains themes collections.
    |
    */
    'directory' => env('THEMES_DIR', 'themes'),

    /*
    |--------------------------------------------------------------------------
    | Symbolic link path
    |--------------------------------------------------------------------------
    |
    | you can change the public themes path used for assets.
    |
    */
    'symlink_path' => 'themes',

    /*
    |--------------------------------------------------------------------------
    | Symbolic link relative
    |--------------------------------------------------------------------------
    |
    | Determine if relative symlink should be used instead of absolute one.
    |
    */
    'symlink_relative' => false,

    /*
    |--------------------------------------------------------------------------
    | Fallback Theme
    |--------------------------------------------------------------------------
    |
    | If you don't set a theme at runtime (through middleware for example)
    | the fallback theme will be used automatically.
    |
    */
    'fallback_theme' => null,

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Config for caching feature.
    |
    */
    'cache' => [
        'enabled'  => false,
        'key'      => 'themes-manager',
        'lifetime' => 86400,
    ],

    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Config for composer.json file, generated for new theme
    | If null then information will be asked at generation process
    | If not null, values will be used at generation process
    |
    */
    'composer' => [
        'vendor' => null,
        'author' => [
            'name'  => null,
            'email' => null,
        ],
    ],

    'settings' => [
        'database_table_name' => 'theme_settings',
        'cache_key' => 'themes_manager_settings_',
    ],
    'menus' => [
        'database_table_name' => 'theme_menus',
        'menu_items_database_table_name' => 'theme_menu_items',
        'cache_key' => 'themes_manager_menus_',
    ],
    'widgets' => [
        'database_table_name' => 'theme_widgets',
        'location_database_table_name' => 'theme_widget_locations',
        'cache_key' => 'themes_manager_widgets_',
    ]
];
