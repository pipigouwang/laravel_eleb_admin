<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $keyword=$request->keyword;
        if($keyword){
            $users=Users::where('name','like',"%{$keyword}%")->paginate(5);
        }else{
            $users =Users::paginate(5);
        }
        return view('users/index',compact('users','keyword'));
    }

    public function create()
    {
        $shops=Shops::all();
        return view('users/create',compact('users'),compact('shops'));
    }

    public function store(Request $request)
    {
        //验证填写信息
        $this->validate($request,[
            'name'=>'required|max:20',
            'email'=>'required|max:20',
        ],[
            'name.required'=>'名称必填!',
            'name.max'=>'不能超过20个字!',
            'email.required'=>'邮箱必填',
            'email.max'=>'邮箱最大不超过20位数',
        ]);
        //处理上传文件,没有上传就给个默认值
        $file = $request->head;
        if(empty($file)) {
            $fileName = "public/img/i8NCDJ84fZNyUe4yxUVPeLwj3puzkPtIhhgO32SZ.jpeg";
        }else{
            $fileName = $file->store('public/head');
        }
        //添加数据
        Users::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'shop_id'=>$request->shop_id,
            'status'=>$request->status,
            'head'=>$fileName
        ]);
        //设置提示信息
        //第一种跳转
//        session()->flash('success','添加成功');
//        return redirect()->route('users.index');
        //第二种
        return redirect('/users')->with('success','添加成功');
    }
    public function edit(Users $user)
    {
//        if(Auth::user()->id != $user->id){
//        return back()->with('danger','只能修改你自己的资料');
// }
        $shops=Shops::all();
        return view('users/edit',['user'=>$user,'shops'=>$shops]);
    }

    public function update(Users $user,Request $request)
    {
        //验证填写信息
        $this->validate($request,[
            'name'=>'required|max:20',
            'email'=>'required|max:20',
        ],[
            'name.required'=>'名称必填!',
            'name.max'=>'不能超过20个字!',
            'email.required'=>'邮箱必填',
            'email.max'=>'邮箱最大不超过20位数',
        ]);
        //修改上传文件
        $file = $request->head;
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'shop_id'=>$request->shop_id,
            'status'=>$request->status,
            'password'=>bcrypt($request->password),
        ];
        if($file){
            $fileName = $file->store('public/head');
            $data['head']= $fileName ;
        }
       // var_dump($data);die;
        //修改数据
        $user->update($data);
        //var_dump($a);die;
        session()->flash('success','修改成功');
        return redirect()->route('users.index');
    }
    //删除数据
    public function destroy(Users $user)
    {
        $user->delete();
        session()->flash('success','删除成功');
        return redirect()->route('users.index');
    }
}
