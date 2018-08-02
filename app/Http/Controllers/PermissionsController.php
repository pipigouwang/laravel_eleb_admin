<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $permissions=Permission::paginate(5);
        return view('Permissions/index',compact('permissions'));
    }
    public function create(){
        return view('Permissions/add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:permissions'
        ],[
            'name.required'=>'权限名未填写',
            'name.unique'=>'权限名已存在'
        ]);
        Permission::create([
            'name'=>$request->name
        ]);
        return redirect()->route('permissions.index')->with('success','添加成功');
    }
    public function edit(Permission $permission){
        return view('Permissions/edit',compact('permission'));
    }
    public function update(Request $request,Permission$permission){
        $this->validate($request,[
            'name'=>'required|unique:permissions,name,'.$request->id
        ],[
            'name.required'=>'权限名未填写',
            'name.unique'=>'权限名已存在'
        ]);
        $permission->update([
            'name'=>$request->name
        ]);
        return redirect()->route('permissions.index')->with('success','修改成功');
    }
    public function destroy(Permission $permission){
        $permission->delete();
        return redirect()->route('permissions.index')->with('success','删除成功');
    }
}
