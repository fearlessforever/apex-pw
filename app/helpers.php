<?php

if (!function_exists('hash_password')) {
    /**
     * Hash the give password
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

if (! function_exists('salt_md5')) {
    /**
     * Hash the given value with base64md5.
     *
     * @param  string  $value
     * @param  array  $options
     * @return string
     */
    function salt_md5($value, $options = [])
    {
        return app('hash')->driver('saltmd5')->make($value, $options);
    }
}
