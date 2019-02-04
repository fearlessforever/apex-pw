<?php

if (! function_exists('active_nav')) {
    function active_nav(string $route) : string
    {
        if (is_null($route)) {
            return null;
        }

        if (\Route::currentRouteNamed($route)) {
            return 'is-active';
        }

        return '';
    }
}
