@extends('default_admin');
@section('contents')
    <h1>修改管理员</h1>
    @include('_errors')
    <form method="post" action="{{route('admin.password',['admin'=>$admin])}}" enctype="multipart/form-data">
        <div class=" container" >
            旧密码: <input type="password" name="oldpassword"><br>
            新密码: <input type="password" name="password"><br>
            确认密码: <input type="password" name="repassword"><br>
            {{ csrf_field() }}
            {{method_field("PATCH")}}
            <button type="submit" class="btn btn-info" >提交</button>
        </div>
    </form>
@endsection