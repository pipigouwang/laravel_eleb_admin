@extends('default_shopcates')
@section('contents')
<h1>注册商家信息</h1>
@include('_errors')
<form method="post" action="{{route('shops.store')}}" enctype="multipart/form-data">
   <div class="container">
       <div class="form-group">
           <label>店铺分类ID</label>
           <select name="shop_category_id" id="">
               @foreach( $shopscategories as $shopscategory);
               <option value="{{$shopscategory->id}}">{{$shopscategory->name}}</option>
               @endforeach
           </select>
       </div>
       <ul>名称: <input type="text" name="shop_name"></ul>
       <ul>
               <label>店铺图片</label>
               <input type="file" name="shop_img">
         </ul>
       <ul>评分: <input type="text" name="shop_rating"></ul>
       <ul>是否是品牌: <input type="radio" name="brand" value="1">是
           <input type="radio" name="brand" value="0">否</ul>
       <ul>是否准时达: <input type="radio" name="on_time" value="1">是
           <input type="radio" name="on_time" value="0">否</ul>
       <ul>是否蜂鸟送:<input type="radio" name="fengniao" value="1">是
           <input type="radio" name="fengniao" value="0">否</ul>
       <ul>是否保标记:<input type="radio" name="bao" value="1">是
           <input type="radio" name="bao" value="0">否</ul>
       <ul>是否票标记:<input type="radio" name="piao" value="1">是
           <input type="radio" name="piao" value="0">否</ul>
       <ul>是否准标记:<input type="radio" name="zhun" value="1">是
           <input type="radio" name="zhun" value="0">否</ul>
       <ul>起送金额: <input type="text" name="start_send"></ul>
       <ul>配送费 <input type="text" name="send_cost"></ul>
       <ul>店公告 <input type="text" name="notice"></ul>
       <ul>优惠信息 <input type="text" name="discount"></ul>
       {{--<ul>状态<input type="radio" name="status" value="1">正常--}}
           {{--<input type="radio" name="status" value="0">审核--}}
           {{--<input type="radio" name="status" value="-1">禁用</ul>--}}
       <h1>注册用户</h1>
       <div class=" container" >
           用户名: <input type="text" name="name" value="{{old('name')}}"><br>
           密码: <input type="text" name="password" value="{{old('password')}}"><br>
           邮箱: <input type="email" name="email" value="{{old('password')}}"><br>
           <div class="form-group">
               <label>所属商家ID</label>
               <select name="shop_id" id="">
                   @foreach( $shops as $shop);
                   <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                   @endforeach
               </select>
           </div>
           <div class="form-group">
               <input id="captcha" class="form-control" name="captcha" >
               <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
           </div>
           <div class="form-group">
               <label>头像</label>
               <input type="file" name="head">
           </div>
           {{ csrf_field() }}
    </div>
       <div class="form-group">
           <button type="submit" class="btn btn-info" >提交</button>
       </div>
</form>
@endsection