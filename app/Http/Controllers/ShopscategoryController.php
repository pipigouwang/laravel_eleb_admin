<?php

namespace App\Http\Controllers;

use App\Models\Shopscategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopscategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
   $shopscategories=Shopscategory::paginate(3);
   return view('shopscategory/index', compact('shopscategories'));
    }
    public function create()
    {
        return view('shopscategory/create');
    }
    public function store(Request $request)
    {
        //验证填写信息
        $this->validate($request,[
            'name'=>'required|max:10',
            'status'=>'required'
        ],[
            'name.required'=>'名称必填!',
            'name.max'=>'不能超过10个字!',
            'status.required'=>'状态必选!',
        ]);
        //处理上传文件
        $file = $request->img;
        $fileName = $file->store('public/img');
        Shopscategory::create(
            [
                'name'=>$request->name,
                'status'=>$request->status,
                'img'=>$fileName,
            ]
        );
        return redirect()->route('shopscategory.index')->with('success','添加成功');
    }
    public function edit(Shopscategory $shopscategory)
    {
        return view('shopscategory/edit',compact('shopscategory'));
    }

    public function update(Shopscategory $shopscategory, Request $request)
    {
        //验证填写信息
        $this->validate($request,[
            'name'=>'required|max:20',
            'status'=>'required',
        ],[
            'name.required'=>'名称必填!',
            'name.max'=>'不能超过20个字!',
            'status.required'=>'状态必选!',

        ]);
        //修改上传文件
        $file = $request->img;
        $data=[
            'name'=>$request->name,
            'status'=>$request->status,
        ];
        if($file){
            $fileName = $file->store('public/img');
            $data['img']= $fileName ;
        }
        //修改数据
        $shopscategory->update($data);
        session()->flash('success','修改成功');
        return redirect()->route('shopscategory.index');
    }
    public function destroy(Shopscategory $shopscategory)
    {
        $shopscategory->delete();
        session()->flash('success','删除成功');
        return redirect()->route('shopscategory.index');
    }
}
