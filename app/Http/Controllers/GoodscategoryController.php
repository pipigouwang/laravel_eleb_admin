<?php

namespace App\Http\Controllers;

use App\Models\Goodscategory;
use Illuminate\Http\Request;

class GoodscategoryController extends Controller
{
    //
    public function index()
    {
        //echo'商品分类';
        $goodscategories=Goodscategory::paginate(3);
        return view('goodscategory/index', compact('goodscategories'));
    }

    public function create()
    {
        return view('goodscategory/create');
    }
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name' => 'required|max:10'
        ], [
            'name.required' => '分类不能为空',
            'name.max' => '分类名不能超过10个字'
        ]);
       Goodscategory::create([
            'name' => $request->name
        ]);
        session()->flash('success', '添加成功');
        return redirect()->route('goodscategory.index');
    }
    //修改分类
    public function edit(Goodscategory $goodscategory)
    {
        return view('goodscategory/edit',compact('goodscategory'));
    }
    //
    public function update(Goodscategory $goodscategory,Request $request)
    {
        //数据验证
        $this->validate($request, [
            'name' => 'required|max:10'
        ], [
            'name.required' => '分类不能为空',
            'name.max' => '分类名不能超过10个字'
        ]);
        $goodscategory->update([
            'name'=>$request->name
        ]);
        session()->flash('success','更新成功');
        return redirect()->route('goodscategory.index');
    }
    public function destroy(Goodscategory $goodscategory)
    {
        $goodscategory->delete();
        session()->flash('success','删除成功');
        return redirect()->route('goodscategory.index');
    }
}
