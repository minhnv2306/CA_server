<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Helper\MessageHelper;
use Illuminate\Support\Facades\Validator;
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
    public function checkCreate(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);
            if($validator->fails()){
                return MessageHelper::errorResponse([],MessageHelper::getMessageErros($validator->errors()));
            }
            return self::successResponse();
    }
    public function store(UserRequest $request)
    {
        $data = $request->except('password_confirmation');
        try {
            User::create($data);
            return redirect()->back()->with('messages', 'Tạo thành công');
        } catch (Exception $ex) {
            return redirect()->back()->with('errors', $ex->getMessage());
        }
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
