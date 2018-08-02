@extends('default_admin');
@section('contents')
    <h1>修改密码</h1>
    @include('_errors')
    <form method="post" action="" enctype="multipart/form-data">
        <div class=" container" >
            密码: <input type="password" name="password" value="{{$admin->password}}"><br>
            {{ csrf_field() }}
            {{method_field("PATCH")}}
            <button type="submit" class="btn btn-info" >提交</button>
        </div>
    </form>
@endsection