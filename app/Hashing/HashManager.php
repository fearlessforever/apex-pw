<?php

namespace App\Hashing;

use Illuminate\Support\Manager;
use Illuminate\Contracts\Hashing\Hasher;

class HashManager extends Manager implements Hasher
{
    /**
     * Create an instance of the Md5 hash Driver.
     *
     * @return \Illuminate\Hashing\BcryptHasher
     */
    public function createSaltmd5Driver()
    {
        return new Saltmd5Hasher($this->app['config']['hashing.md5'] ?? []);
    }

    /**
     * Create an instance of the Base64 Md5 hash Driver.
     *
     * @return \Illuminate\Hashing\BcryptHasher
     */
    public function createBase64md5Driver()
    {
        return new Base64md5Hasher($this->app['config']['hashing.base64md5'] ?? []);
    }

    /**
     * Get information about the given hashed value.
     *
     * @param  string  $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        return $this->driver()->info($hashedValue);
    }

    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public function make($value, array $options = [])
    {
        return $this->driver()->make($value, $options);
    }

    /**
     * Check the given plain value against a hash.
     *
     * @param  string  $value
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        return $this->driver()->check($value, $hashedValue, $options);
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string  $hashedValue
     * @param  array   $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return $this->driver()->needsRehash($hashedValue, $options);
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['hashing.driver'];
    }
}
