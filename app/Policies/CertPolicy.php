<?php

namespace App\Policies;

use App\Cert;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CertPolicy
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
        return true;
    }
}
