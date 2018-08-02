<?php

namespace App\Http\Controllers;

use App\Models\Menuses;
use App\Models\OrderGoods;
use App\Models\Orders;
use App\Models\Ordersgoods;
use App\Models\Oredersgoods;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth',[
//            'except'=>[]
//        ]);
//    }

    public function index(Request $request){
        $shop = Shops::where('status',1)->get();
        $arr = [];
        foreach ($shop as $v){
            $time = date('Y-m-d',time());
            $time1 = date('Y-m',time());
            $day = Orders::where([['shop_id',$v->id],['created_at','like',"%{$time}%"]])->count();
            $v['day']=$day;
            $month = Orders::where([['shop_id',$v->id],['created_at','like',"%{$time1}%"]])->count();
            $v['mouth']=$month;
            $count = Orders::where('shop_id',$v->id)->count();
            $v['count']=$count;
            $arr[] = $v;
        }
        usort($arr,function($a,$b){
            return  -($a['count']<=>$b['count']);
        });
       // dd($arr);
        return view('count/order',compact('shop','total'));
    }
    public function order_month(Request $request)
    {
        $shop_create_min_time = substr(Shops::min('created_at'),0,4);
        $now_time = date('Y',time());
        $years = [];
        for($i=$shop_create_min_time;$i<=$now_time;++$i){
            $years[] = $i;
        }
        $year = date('Y',time());
        $month = date('m',time());
        if($request->year>$year){
            return redirect()->back()->with('danger','不能查看未来的订单');
        }
        if($request->month){
            $month = $request->month;
        }
        if($request->year){
            $year = $request->year;
        }
        $year_month =$year.'-'.$month ;
        $order =  DB::select("SELECT shop_name,SUM(amount_t.amount) as sum from 
(SELECT amount,goods_id,menuses.shop_id,ordersgoods.created_at from ordersgoods 
INNER JOIN menuses on ordersgoods.goods_id = menuses.id ) as amount_t 
INNER JOIN shops on amount_t.shop_id = shops.id 
WHERE amount_t.created_at like '{$year_month}%' GROUP BY shop_id ORDER BY sum DESC LIMIT 8");;
        return view('count/order_month',compact('years','order','year','month'));
    }
    public function order_day (Request $request)
    {
        $time = substr(date('Y-m-d',time()),0,10);
        if($time<$request->day){
            return redirect()->back()->with('danger','不能查看未来的订单');
        }
        if($request->day){
            $time = $request->day;
        }
        $day =  DB::select("SELECT shop_name,SUM(amount_t.amount) as sum from 
(SELECT amount,goods_id,menuses.shop_id,ordersgoods.created_at from ordersgoods 
INNER JOIN menuses on ordersgoods.goods_id = menuses.id ) as amount_t 
INNER JOIN shops on amount_t.shop_id = shops.id 
WHERE amount_t.created_at like '{$time}%' GROUP BY shop_id ORDER BY sum DESC LIMIT 8") ;
        return view('count/order_day',compact('day','time'));
    }

    public function menu ()
    {
        $menu = Menuses::all();
        $arr = [];
        foreach ($menu as &$v){
            $time = date('Y-m-d',time());
            $day = Ordersgoods::select('amount')->where([['goods_id',$v->id],['created_at','like',"%{$time}%"]])->sum('amount');
            $v['day']=$day;
            $time1 = date('Y-m',time());
            $mouth = Ordersgoods::select('amount')->where([['goods_id',$v->id],['created_at','like',"%{$time1}%"]])->sum('amount');
            $v['mouth']=$mouth;
            $count = Ordersgoods::select('amount')->where([['goods_id',$v->id]])->sum('amount');
            $v['count']=$count;
            $arr[] = $v;
        }
        usort($arr,function($a,$b){
            return  -($a['count']<=>$b['count']);
        });
        return view('count/menu',compact('menu'));
    }
    public function menu_month (Request $request)
    {
        $min_year = Menuses::min('created_at');
        $now_time = date('Y',time());
        $years = [];
        for($i=substr($min_year,0,4);$i<=$now_time;++$i){
            $years[] = $i;
        }
        $year = date('Y',time());
        $month = date('m',time());
        if($request->year > $year){
            return redirect()->back()->with('danger','不能查看未来的菜品销量');
        }
        if($request->year){
            $year = $request->year;
        }
        if($request->month){
            $month = $request->month;
        }
        $year_month =$year.'-'.$month ;
        $menu = DB::select("select s.shop_name,m.goods_name,sum(g.goods_id) as sum from `menuses` as m join `shops` as s on s.id=m.shop_id join `ordersgoods` as g on g.goods_id=m.id where g.created_at like '%{$year_month}%' group by g.goods_id order by sum desc limit 0,10");
        return view('count/menu_month',compact('menu','years','year','month'));
    }
    public function menu_day (Request $request)
    {
        $min_year = Menuses::min('created_at');
        $now_time = date('Y',time());
        $years = [];
        for($i=substr($min_year,0,4);$i<=$now_time;++$i){
            $years[] = $i;
        }
        $year = date('Y',time());
        $month = date('m',time());
        if($request->year > $year){
            return redirect()->back()->with('danger','不能查看未来的菜品销量');
        }
        if($request->year){
            $year = $request->year;
        }
        if($request->month){
            $month = $request->month;
        }
        $time = date('Y-m-d',time());
        if($time<$request->day){
            return redirect()->back()->with('danger','不能查看未来的菜品销量');
        }
        if($request->day){
            $time = $request->day;
        }
        $day = DB::select("select s.shop_name,m.goods_name,sum(g.goods_id) as sum from `menuses` as m join `shops` as s on s.id=m.shop_id join `ordersgoods` as g on g.goods_id=m.id where g.created_at like '%{$time}%' group by g.goods_id order by sum desc limit 0,10");
        return view('count/menu_day',compact('day','years','time'));
    }
}
