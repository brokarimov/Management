<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function index()
    {
        return view('login.loginPage');
    }
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:5'
            ]
        );
        // dd($request->all());
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::user();
            return redirect('/');
        }else{
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
        return view('pages.profile');
    }
    public function profileChange(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        // dd($user);
        $user->save();
        return redirect('/profile')->with('success', 'Ma\'lumotlar o\'zgartirildi!');
    }
}
