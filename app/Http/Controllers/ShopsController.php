<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use App\Models\Shopscategory;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       $shops= Shops::paginate(5);
        return view('shops/index', compact('shops'));
    }
//同步注册
    public function register()
    {
        $shopscategories=Shopscategory::all();
        $users=Users::all();
        $shops=Shops::all();
        return view('shops/register',['users'=>$users,'shopscategories'=>$shopscategories,'shops'=>$shops]);
    }

//    public function info()
//    {
//        $shopscategories=Shopscategory::all();
//        $users=Users::all();
//        $shops=Shops::all();
//        return view('shops/info',['users'=>$users,'shopscategories'=>$shopscategories,'shops'=>$shops]);
//    }
    public function create()
    {
        $shopscategories=Shopscategory::all();
        return view('shops/create',compact('shopscategories'));
    }

    public function store(Request $request)
    {
        //验证填写信息
        $this->validate($request,[
            'shop_category_id'=>'required',
            'shop_name'=>'required|max:10',
            'status'=>'required',
            'name'=>'required|max:20',
            'email'=>'required|max:20',
        ],[
            'shop_category_id.required'=>'店铺ID必填!',
            'shop_name.required'=>'名称必填',
            'shop_name.max'=>'名称不能超过10个字!',
            'status.required'=>'状态必选!',
            'name.required'=>'名称必填!',
            'name.max'=>'不能超过20个字!',
            'email.required'=>'邮箱必填',
            'email.max'=>'邮箱最大不超过20位数',
        ]);

        $file=$request->shop_img;
        if(empty($file)) {
            $fileName = "public/shop_img/dKMtKCDpFk9ql8aBg9zOgbAxEqdDjMjPK3q31Z40.jpeg";
        }else{
            $fileName = $file->store('/public/shop_img');
        }
        DB::transaction(function() use($request,$fileName){
            Shops::create([
                'shop_category_id'=>$request->shop_category_id,
                'shop_name'=>$request->shop_name,
                'shop_img'=>$fileName,
                'shop_rating'=>$request->shop_rating,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
//                'status'=>$request->status,
            ]);
            Users::create([
                'name'=>$request->name,
                'password'=>bcrypt($request->password),
                'email'=>$request->email,
                'shop_id'=>$request->shop_id,
//            'status'=>$request->status,
                'head'=>$fileName
            ]);
        });

        return redirect()->route('shops.index')->with('success','添加成功');
    }
    //修改商家信息
    public function edit(Shops $shop){
        $shopscategories=Shopscategory::all();
        return view('shops/edit',compact('shop'),compact('shopscategories'));
    }
    //保存修改商家信息
    public function update(Shops $shop,Request $request){

        //数据验证
        $this->validate($request,[
            'shop_category_id'=>'required',
            'shop_name'=>'required',
            'shop_rating'=>'required',
            'brand'=>'required',
            'on_time'=>'required',
            'fengniao'=>'required',
            'bao'=>'required',
            'piao'=>'required',
            'zhun'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            'discount'=>'required',
            'status'=>'required',
        ],[
            'shop_category_id.required'=>'请填写店铺分类ID',
            'shop_name.required'=>'请填写名称',
            'shop_rating.required'=>'请填写评分',
            'brand.required'=>'请填写是否是品牌',
            'on_time.required'=>'请填写是否准时送达',
            'fengniao.required'=>'请填写是否蜂鸟配送',
            'bao.required'=>'请填写是否保标记',
            'piao.required'=>'请填写是否票标记',
            'zhun.required'=>'请填写是否准标记',
            'start_send.required'=>'请填写起送金额',
            'send_cost.required'=>'请填写配送费',
            'notice.required'=>'请填写店公告',
            'discount.required'=>'请填写优惠信息',
            'status.required'=>'请填写状态',
        ]);

        $file=$request->shop_img;

        $data=[
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status,
        ];

        if($file){
            $fileName=$file->store('public/shop_img');
            $data['shop_img']=$fileName;
        }
        $shop->update($data);

        session()->flash('success','操作成功');

        return redirect()->route('shops.index');
    }

    //删除商家信息
    public function destroy(Shops $shop){

        $shop->delete();

        session()->flash('success','操作成功');

        return redirect()->route('shops.index');
    }
//审核是否通过
    public function info(Shops $shop ,Request $request)
    {
        //dd($shop->email);
       // $shopscategories=Shopscategory::all();
        //$users=Users::all();
        return view('shops/info',compact('shop'));
    }
    //修改审核
    public function status(Shops $shop,Request $request)
    {
        $shop->update([
            'status'=>$request->status
        ]);
        return redirect()->route('shops.index')->with('success','审核通过');
    }

}


