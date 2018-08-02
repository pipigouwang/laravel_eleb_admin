@extends('default_admin')
@section('contents')
    <form method="post" action="{{route('shops.update',[$shop])}}" enctype="multipart/form-data">
        <div style="text-align: center"><h4>修改商家信息</h4></div>
        @include('_errors')
        {{--<div class="form-group">--}}
            {{--<label>店铺分类ID</label>--}}
            {{--<input type="text" name="shop_category_id" class="form-control" placeholder="店铺分类ID" value="{{ $shop->shop_category_id }}">--}}
        {{--</div>--}}
        <div class="form-group">
            <label>店铺分类ID</label>
            <select name="shop_category_id" id="">
                @foreach($shopscategories as $student);
                <option  {{$student->id==$shop->shop_category_id?'selected':''}}   value="{{$student->id}}">{{$student->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="shop_name" class="form-control" placeholder="名称" value="{{ $shop->shop_name }}">
        </div>
        <div class="form-group">
            <label>店铺图片</label>
            <input type="file" name="shop_img">
            <img src="{{ $shop->shop_img() }}" width="100px">
        </div>
        <div class="form-group">
            <label>评分</label>
            <input type="text" name="shop_rating" class="form-control" placeholder="评分" value="{{ $shop->shop_rating }}">
        </div>
        <div class="form-group">
            <label>是否是品牌</label>
            <input type="radio" name="brand" value="1" {{$shop->brand==1?'checked':''}}>是
            <input type="radio" name="brand" value="0"
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
            <input type="text" name="start_send" class="form-control" placeholder="起送金额" value="{{ $shop->start_send }}">
        </div>
        <div class="form-group">
            <label>配送费</label>
            <input type="text" name="send_cost" class="form-control" placeholder="配送费" value="{{ $shop->send_cost }}">
        </div>
        <div class="form-group">
            <label>店公告</label>
            <textarea name="notice" class="form-control" placeholder="店公告">{{ $shop->notice }}</textarea>
        </div>
        <div class="form-group">
            <label>优惠信息</label>
            <textarea name="discount" class="form-control" placeholder="优惠信息">{{ $shop->discount }}</textarea>
        </div>
            <div class="form-group">
                <label>状态</label>
                <input type="radio" name="status" value="1" {{$shop->status==1?'checked':''}}>正常
                <input type="radio" name="status" value="0"
                        {{$shop->status==0?'checked':''}}>待审核
                <input type="radio" name="status" value="-1"
                        {{$shop->status==-1?'checked':''}}>禁用
            </div>
        </div>
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <button class="btn btn-primary btn-block">修改商家信息</button>
    </form>
@endsection