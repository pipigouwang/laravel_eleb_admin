@extends('default_shopcates');
@section('contents')
<h1>添加用户</h1>
@include('_errors')
<form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
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

        是否启用: <input type="radio" name="status" value="1">是
        <input type="radio" name="status" value="0">否
        <br>
        {{ csrf_field() }}
    <button type="submit" class="btn btn-info" >提交</button>
    {{csrf_field()}}
    </div>
</form>
@endsection