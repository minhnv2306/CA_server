<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use App\Helper\MessageHelper;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['deleted_id'] = 0;
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('error', 'Sai sai');
    }

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
            return MessageHelper::successResponse();
    }
    public function store(UserRequest $request)
    {
        $data = $request->except('password_confirmation');
        $data['password'] = bcrypt($data['password']);
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
            if (Auth::user()->can('edit', $user)) {
                $user->update($request->all());
                return redirect()->back()->with('messages', 'Cập nhật thành công!');
            } else {
                return view('error.403');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('errors', $ex->getMessage());
        }
    }
    public function profile()
    {
        return view('user.show', [
            'user' => Auth::user(),
        ]);
    }
    public function changePassword(NewPasswordRequest $request)
    {
        if (User::checkAccount(Auth::user()->email, $request['old_password'])) {
            try {
                User::find(Auth::user()->id)->update([
                    'password' => bcrypt($request->new_password)
                ]);
                return redirect()->back()->with('messages', 'Đổi mật khẩu thành công!');
            } catch (Exception $ex) {
                return redirect()->back()->with('errors', $ex->getMessage());
            }
        } else {
            return redirect()->back()->with('errors', 'Thông tin mật khẩu chưa chính xác');
        }

    }
    public function destroy(User $user)
    {
        try {
            if (Auth::user()->can('delete', $user)) {
                $user->update([
                    'deleted_id' => Auth::user()->id,
                ]);

                return redirect()->back()->with('messages', 'Xóa thành công!');
            } else {
                return view('error.403');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('errors', $ex->getMessage());
        }
    }
}
