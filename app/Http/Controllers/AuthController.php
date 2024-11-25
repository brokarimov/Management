<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\login\LoginRequest;
use App\Jobs\SendEmail;
use App\Models\TerritoryTask;
use App\Models\User;
use App\Models\VerifyCode;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function index()
    {
        return view('login.loginPage');
    }
    public function login(LoginRequest $request)
    {
        // dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function profile()
    {
        $AlertCount = TerritoryTask::where('status', 3)->count();
        return view('pages.profile', ['AlertCount' => $AlertCount]);
    }
    public function profileChange(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('/profile')->with('success', 'Ma\'lumotlar o\'zgartirildi!');
    }

    public function verifyPage()
    {
        $AlertCount = TerritoryTask::where('status', 3)->count();
        $code = rand(1000, 9999);

        $data = VerifyCode::create([
            'user_id' => auth()->user()->id,
            'code' => $code,
        ]);
        SendEmail::dispatch(auth()->user()->email, $data);

        return view('login.verify', ['AlertCount' => $AlertCount]);
    }

    public function PasswordChange(Request $request)
    {
        $user = auth()->user();
        $code = VerifyCode::where('user_id', $user->id)->where('code', $request->code)->first();
        $AlertCount = TerritoryTask::where('status', 3)->count();

        if ($code && $request->code == $code->code) {
            return view('login.password',['AlertCount' => $AlertCount]);
        } else {
            return redirect()->back();
        }
    }

    public function PasswordUpdate(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->password = $request->password;
        $user->save();
        return redirect('/profile')->with('success', 'Ma\'lumotlar o\'zgartirildi!');
    }
}
