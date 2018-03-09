<?php

namespace App\Policies;

use App\User;
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

    }
    public function manager(User $user)
    {
        $edit = json_decode($user->role->edit);
        if (empty($edit)) {
            $edit = array();
        }
        if (in_array(1, $edit)) {
            return true;
        } else {
            return false;
        }
    }
}
