<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index', [
           'roles' => Role::all(),
        ]);
    }
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return redirect()->back()->with('messages', 'Xóa thành công!');
        } catch (Exception $ex) {
            return redirect()->back()->with('errors', $ex->getMessage());
        }
    }
}
