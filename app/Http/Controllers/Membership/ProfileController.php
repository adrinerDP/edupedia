<?php

namespace App\Http\Controllers\Membership;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('pages.membership.profile');
    }

    public function editProfile(Request $request)
    {
        $this->validate($request, [
            'uuid' => 'required|alpha_dash|unique:users,uuid,'.request()->user()->id,
            'name' => 'required|alpha'
        ]);

        $user = User::where('id', $request->user()->id)->first();

        $user->uuid = $request->uuid;
        $user->name = $request->name;
        $user->update();

        return redirect()->route('profile', $user->uuid)->with('success', '프로필이 수정되었습니다!');
    }

    public function editPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'password_new' => 'required|case_diff|numbers|letters|symbols|min:8',
            'password_check' => 'required|same:password'
        ]);

        $user = User::where('id', $request->user()->id)->first();

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('profile', $user->uuid)->with('danger', '비밀번호를 확인해주세요!');
        }

        $user->password = Hash::make($request->password_new);
        $user->update();

        return redirect()->route('profile', $user->uuid)->with('success', '비밀번호가 변경되었습니다!');
    }
}
