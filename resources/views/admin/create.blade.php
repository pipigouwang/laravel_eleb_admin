@extends('default_admin');
@section('contents')
<h1>添加管理员</h1>
@include('_errors')
<form method="post" action="{{route('admin.store')}}">
    <div class=" container" >
        用户名: <input type="text" name="name" value="{{old('name')}}"><br>
        密码: <input type="text" name="password" value="{{old('password')}}"><br>
        邮箱: <input type="email" name="email" value="{{old('password')}}"><br>
        <div class="form-group">
            <input id="captcha" class="form-control" name="captcha" >
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">角色</label>
            <div class="col-sm-10">
                @foreach($roles as $id=>$role)
                    <label class="checkbox-inline">
                        <input type="checkbox" name="role[]" value="{{$id}}"> {{$role}}
                    </label>
                @endforeach
            </div>
        </div>
        {{ csrf_field() }}
    <button type="submit" class="btn btn-info" >提交</button>
    </div>
</form>
@endsection