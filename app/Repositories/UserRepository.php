<?php

namespace App\Repositories;

use App\User;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{

    /**
     * Get authenticated user.
     *
     * @return void
     */
    public function current()
    {
        if (auth()->check()) {
            return $this->find(auth()->user()->ID);
        }
    }

    /**
     * Get user.
     *
     * @param $id
     * @return void
     */
    public function find($id)
    {
        $user = User::find($id);

        return $user;
    }
}
