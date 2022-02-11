<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return $user->email == 'admin@test.com';
    }

    public function edit(User $user)
    {
        return $user->email == 'admin@test.com';
    }

    public function delete(User $user)
    {
        return $user->email == 'admin@test.com';
    }
}
