<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //echo'1';
        $admins = Admin::all();
        return view('admin/index', compact('admins'));
    }

    public function create()
    {
        $roles=Role::pluck('name','id');
        return view('admin/create', compact('admin','roles'));
    }

    public function store(Request $request)
    {
        //验证填写信息
        $this->validate($request, [
            'name' => 'required|max:20',
            'email' => 'required|max:20',
        ], [
            'name.required' => '名称必填!',
            'name.max' => '不能超过20个字!',
            'email.required' => '邮箱必填',
            'email.max' => '邮箱最大不超过20位数',
        ]);
        //添加管理员
        Admin::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
        ])->assignRole($request->role);
        return redirect()->route('admin.index')->with('success', '添加成功');
    }

    public function edit(Admin $admin)
    {
        $roles=Role::pluck('name','id');
        return view('admin/edit', compact('admin','roles'));
    }

    public function update(Admin $admin, Request $request)
    {
        $admin->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]

        );
        return redirect()->route('admin.index')->with('success', '修改成功');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.index')->with('success', '删除成功');
    }

    public function pass(Admin $admin)
    {
        return view('Admin/pass',compact('admin'));
    }

    public function password(Request $request,Admin $admin)
    {
        if($request->repassword!=$request->password){
            return back()->with('success', '确认密码与输入密码不一致');
        }
        $this->validate($request,[
            'password'=>'required',
            'oldpassword'=>'required',
            'repassword'=>'required',
        ]);
        if(Hash::check($request->oldpassword,Auth::user()->password)){
            $admin->update([
                'password'=>bcrypt($request->password)
            ]);
            return redirect()->route('login')->with('success', '修改成功'); //修改成功
        }else{
            return back()->with('success', '修改失败旧密码错误'); //修改失败
            }
    }


}
