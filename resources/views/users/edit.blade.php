@extends('default_shopcates');
@section('contents')
    <h1>修改用户</h1>
    @include('_errors')
    <form method="post" action="{{route('users.update',[$user])}}" enctype="multipart/form-data">
        <div class="form-group container" >
            用户名: <input type="text" name="name" value="{{$user->name}}"><br>
            密码: <input type="password" name="password" value="{{$user->password}}"><br>
            邮箱: <input type="email" name="email" value="{{$user->email}}"><br>
            <div class="form-group">
                <label>所属商家ID</label>
                <select name="shop_id" id="">
                    @foreach($shops as $student);
                    <option  {{$student->id==$user->shop_id?'selected':''}}   value="{{$student->id}}">{{$student->shop_name}}</option>
                    @endforeach
                </select>
            </div>
            是否使用: <input type="radio" name="status" value="1" {{$user->status==1?'checked':''}} > 是
            <input type="radio" name="status" value="0"  {{$user->status==0?'checked':''}} > 否
            <div class="form-group">
                <label>头像</label>
                <input type="file" name="head">
                <img src="{{$user->head()}}" alt=""  class="img-circle" width="100px" >
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-info" >提交</button>
        {{--表单伪造方法--}}
        {{method_field('PATCH')}}
    </div>
</form>
@endsection