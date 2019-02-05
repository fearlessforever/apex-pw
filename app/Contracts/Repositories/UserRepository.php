<?php

namespace App\Contracts\Repositories;

interface UserRepository
{
    /**
     * Get authenticated user.
     *
     * @return void
     */
    public function current();

    /**
     * Get user.
     *
     * @param $id
     * @return void
     */
    public function find($id);
}
