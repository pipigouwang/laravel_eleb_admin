<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    //
    //角色管理列表
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $roles = Role::paginate(10);
        return view('Roles.index',compact('roles'));
    }
    //添加角色
    public function create(){
        $permissions=Permission::pluck('name','id');
        return view('Roles/create',compact('permissions'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:roles',
        ],[
            'name.required'=>'角色名未填写',
            'name.unique'=>'角色名已存在',
        ]);
        if(is_array($request->permission)) {
            Role::create([
                'name' => $request->name
            ])->syncPermissions($request->permission);
        }else{
            Role::create([
                'name' => $request->name
            ]);
        };
        return redirect()->route('roles.index')->with('success','添加成功');
    }
    public function edit(Role $role)
    {
        $permissions = Permission::pluck('name', 'id');
        return view('Roles/edit',compact('role','permissions'));
    }
    public function update(Role $role,Request $request){
        $this->validate($request,[
            'name'=>'required|unique:roles,name,'.$role->id,
        ],[
            'name.required'=>'角色名未填写',
            'name.unique'=>'角色名已存在',
        ]);
        if($request->permission){
            $role->syncPermissions($request->permission)->update([
                'name' => $request->name
            ]);
        }else{
            $role->update([
                'name' => $request->name
            ]);
        };
        return redirect()->route('roles.index')->with('success','修改成功');
    }
    //查看
//    public function show(Role $role)
//    {
//        $permissions =DB::select("SELECT name from role_has_permissions
//INNER JOIN permissions on role_has_permissions.permission_id = permissions.id
//WHERE '{$role->id}'");
//        return view('Roles/show',compact('role','permissions'));
//    }
    public function destroy(Role $role){
        $role->delete();
        return redirect()->route('roles.index')->with('success','删除成功');
    }
}
