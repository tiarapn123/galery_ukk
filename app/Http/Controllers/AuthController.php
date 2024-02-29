<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function postlogin(Request $request)
    {
        $login = $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        if(Auth::attempt($login))
        {
            Session::put('user_id',auth()->user()->id);
            Session::put('name',auth()->user()->name);

            return redirect()->intended('/galery');
        }


    return back()->withErrors([
        'errors'=>'Username Password Salah'

    ]);
}
    public function postRegister(Request $request)
    {
        $register = $request->validate([
            'username'=>'required',
            'password'=>'required',
            'name'=>'required',
            'repassword'=>'required|same:password',
            'email'=>'required',
            'terms'=>'required',
        ]);
        if($request->password==$request->repassword)
        {
            $ins = User::create([
                'username'=>$request->username,
                'password'=>bcrypt($request->password),
                'name'=>$request->name,
                'email'=>$request->email,
            ]);

        $login = $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        if(Auth::attempt($login))
        {
            Session::put('user_id',auth()->user()->id);
            Session::put('name',auth()->user()->name);

            return redirect()->intended('/galery');
        }

    }
    return redirect('/');
}
  public function logout()
  {
    Auth::logout();
    Session::forget('user_id');
    return redirect('/');
  }
}
