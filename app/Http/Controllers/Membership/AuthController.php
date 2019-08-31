<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.membership.login');
    }

    public function showRegister()
    {
        return view('pages.membership.register');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->password, $user['password'])) {
            Auth::login($user);

            return redirect()->route('home')->with('success', $user->name.'님, 로그인 되었습니다.');
        } else {
            return redirect()->back()->with('danger', '이메일이나 비밀번호를 확인해주세요!');
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|case_diff|numbers|letters|symbols|min:8',
            'password_check' => 'required|same:password',
            'name' => 'required'
        ]);

        $user = User::create([
            'uuid' => (string) Str::uuid(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name
        ]);

        // TODO: EMAIL VERIFICATION

        return redirect()->route('auth.login')->with('success', $user->name.'님, 회원가입이 완료되었습니다!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home')->with('success', '로그아웃 되었습니다.');
    }
}
