@extends('default_admin');
@section('contents')
<h1>修改管理员</h1>
@include('_errors')
<form method="post" action="{{route('admin.update',[$admin])}}" enctype="multipart/form-data">
    <div class=" container" >
        用户名: <input type="text" name="name" value="{{$admin->name}}"><br>
        {{--密码: <input type="password" name="password" value="{{$admin->password}}"><br>--}}
        邮箱: <input type="email" name="email" value="{{$admin->email}}"><br>
        {{ csrf_field() }}
        {{method_field("PATCH")}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">角色</label>
            <div class="col-sm-10">
                @foreach($roles as $id=>$role)
                    <label class="checkbox-inline">
                        <input type="checkbox" name="role[]" value="{{$id}}" {{$admin->hasRole($role)?'checked':''}}> {{$role}}
                    </label>
                @endforeach
            </div>
        </div>
    <button type="submit" class="btn btn-info" >提交</button>
    {{csrf_field()}}
    </div>
</form>
@endsection