<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    //

    public function login()
    {
//        if(Auth::check()){
//            //用户已登录
//            return redirect()->route('admin.index');
//        }
      //  echo'1';
        return view('sessions/index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','注销成功');
    }
    public function store(Request $request)
    {
       // dd($request->rememberMe);
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空'
        ]);
        if (Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password,
        ],$request->remember_token))
        {
            return redirect()->route('admin.index')->with('success','登陆成功');
        }else{
            return back()->with('danger','用户名或者密码错误');
        }
    }

    public function change()
    {
        return view('sessions/password');
    }
}
