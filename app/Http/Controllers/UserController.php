<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::getAllUsers();
        return view('user.index', [
            'users' => $users,
        ]);
    }
    public function store(UserRequest $request)
    {
        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            return redirect()->back()->with('messages', 'Tạo người dùng thành công');
        } catch (Exception $ex) {
            return redirect()->back()->with('errors', $ex->getMessage());
        }
    }
    public function roles()
    {
        dd(1);
    }
    public function update(User $user, Request $request)
    {
        try {
            $user->update($request->all());
            return redirect()->back()->with('messages', 'Cập nhật thành công!');
        } catch (Exception $ex) {
            return redirect()->back()->with('errors', $ex->getMessage());
        }
    }
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->back()->with('messages', 'Xóa thành công!');
        } catch (Exception $ex) {
            return redirect()->back()->with('errors', $ex->getMessage());
        }
    }
}
