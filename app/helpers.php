<?php

if (! function_exists('hash_password')) {
    /**
     * Hash the give password.
     */
    function hash_password($value, $options = []) : string
    {
        switch (config('hashing.driver')) {
            case 'base64md5':
                return app('hash')->driver('base64md5')->make($value, $options);
            break;
            case 'salt_md5':
               return app('hash')->driver('saltmd5')->make($value, $options);
            break;
        }
    }
}

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
