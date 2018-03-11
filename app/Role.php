<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];
    public static function checkPermissionOfRole($role_id, $object_id)
    {
        $operation = DB::table('role_permission')
            ->join('permissions', 'permissions.id', '=', 'role_permission.permission_id')
            ->where('role_id', $role_id)
            ->where('object_id', $object_id)
            ->get();
        if ($operation[0]->operation_id == 0) {
            return 'View';
        } else {
            return 'Edit';
        }
    }
    public static function getAllRole()
    {
        return self::all();
    }
}
