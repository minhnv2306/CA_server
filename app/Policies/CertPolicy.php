<?php

namespace App\Policies;

use App\Models\Cert;
use App\Models\User;
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
    public function create()
    {
        return true;
    }
    public function edit(User $user, Cert $cert)
    {
        return $user->role_id === 1 || $cert->user_id === $user->id;
    }
}
