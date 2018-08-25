<?php

if (! function_exists('base64md5')) {
    /**
     * Hash the given value with base64md5.
     *
     * @param  string  $value
     * @param  array  $options
     * @return string
     */
    function base64md5($value, $options = [])
    {
        return app('hash')->driver('base64md5')->make($value, $options);
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
