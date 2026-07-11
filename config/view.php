<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk and cache them in disk.
    | This option tells Laravel where to find the views and where it may store
    | the compiled versions of the views.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views')) ?: storage_path('framework/views')
    ),

    /*
    |--------------------------------------------------------------------------
    | Blade Extensions
    |--------------------------------------------------------------------------
    |
    | Additional Blade extensions may be registered here if needed.
    |
    */

    'extensions' => [
        'blade.php',
    ],

    /*
    |--------------------------------------------------------------------------
    | Delayed Compiled Views Cleanup
    |--------------------------------------------------------------------------
    |
    | This determines whether compiled Blade views should be checked for stale
    | timestamps before rendering.
    |
    */

    'check_timestamps' => env('VIEW_CHECK_TEMPLATES', true),

];
