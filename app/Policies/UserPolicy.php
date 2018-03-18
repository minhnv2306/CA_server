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
    public function edit(User $user1, User $user2)
    {
        if ($user1->role_id == 1) {
            if ($user2->role_id == 2 || $user2->id == $user1->id) {
                return true;
            }
        }
        if ($user1->role_id == 2 && $user2->id == $user1->id) {
            return true;
        }
        return false;
    }
    public function delete(User $user1, User $user2)
    {
        return ($user1->role_id == 1 && $user2->role_id == 2);
    }
}
