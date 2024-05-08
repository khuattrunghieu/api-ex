<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends AuthApiController
{
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function register(RegisterRequest $request)
    {
        $data_user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = $this->user->create($data_user);
        if ($user) {
            return $this->success('Tạo tài khoản thành công', $user, null);
        }
        return $this->show_error('Tạo tài khoản thất bại');
    }
    public function login(LoginRequest $request)
    {
        $login = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($login) {
            $user = Auth::user();
            $tokenResult = $user->createToken('Token login');
            $token = $tokenResult->token;
            if ($user->remember_me){
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            $token->save();
            return $this->success('Đăng nhập thành công', $user, $tokenResult->accessToken);
        }
    }
}
