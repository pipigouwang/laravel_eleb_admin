@extends('default_shopcates')

@section('contents')
    <h2>商家信息</h2>
    名称:<ul>{{$shop->shop_name}}</ul>
    店铺分类ID:<ul>{{$shop->shop_category_id}}</ul>
<br>
        <label>店铺图片</label>
    <ul>
        <img src="{{ $shop->shop_img() }}" width="100px"></ul>
   评分: <ul>{{$shop->shop_rating}}</ul>
    <div class="form-group">
        <label>是否是品牌</label>
        <input type="radio"   name="brand" value="1" {{$shop->brand==1?'checked':''}}>是
        <input type="radio"    name="brand" value="0"
                {{$shop->brand==0?'checked':''}}>否
    </div>
    <div class="form-group">
        <label>是否准时送达</label>
        <input type="radio" name="on_time" value="1" {{$shop->on_time==1?'checked':''}}>是
        <input type="radio" name="on_time" value="0"
                {{$shop->status==0?'checked':''}}>否
    </div>
    <div class="form-group">
        <label>是否蜂鸟配送</label>
        <input type="radio" name="fengniao" value="1" {{$shop->fengniao==1?'checked':''}}>是
        <input type="radio" name="fengniao" value="0"
                {{$shop->status==0?'checked':''}}>否
    </div>
    <div class="form-group">
        <label>是否保标记</label>
        <input type="radio" name="bao" value="1" {{$shop->bao==1?'checked':''}}>是
        <input type="radio" name="bao" value="0"
                {{$shop->status==0?'checked':''}}>否
    </div>
    <div class="form-group">
        <label>是否票标记</label>
        <input type="radio" name="piao" value="1" {{$shop->piao==1?'checked':''}}>是
        <input type="radio" name="piao" value="0"
                {{$shop->status==0?'checked':''}}>否
    </div>
    <div class="form-group">
        <label>是否准标记</label>
        <input type="radio" name="zhun" value="1" {{$shop->zhun==1?'checked':''}}>是
        <input type="radio" name="zhun" value="0"
                {{$shop->status==0?'checked':''}}>否
    </div>
    <div class="form-group">
        <label>起送金额</label>
        <input readonly="" type="text" name="start_send" class="form-control" placeholder="起送金额" value="{{ $shop->start_send }}">
    </div>
    <div class="form-group">
        <label>配送费</label>
        <input  readonly="" type="text" name="send_cost" class="form-control" placeholder="配送费" value="{{ $shop->send_cost }}">
    </div>
    <div class="form-group">
        <label>店公告</label>
        <textarea  readonly="" name="notice" class="form-control" placeholder="店公告">{{ $shop->notice }}</textarea>
    </div>
    <div class="form-group">
        <label>优惠信息</label>
        <textarea name="discount"   readonly="" class="form-control" placeholder="优惠信息">{{ $shop->discount }}</textarea>
    </div>
    <form action="{{route('shops.status',[$shop])}}" method="post">
        <input type="hidden" name="status" value="1">
        <button type="submit">提交审核</button>
        {{csrf_field()}}
    </form>
@stop