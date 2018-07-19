@extends('default_shopcates')
@section('contents')
    <h1>修改</h1>
    @include('_errors')
    <form method="post" action="{{route('shopscategory.update',[$shopscategory])}}" enctype="multipart/form-data">
        分类名: <input type="text" name="name" value="{{$shopscategory->name}}"><br>
        是否上架: <input type="radio" name="status" value="1" {{$shopscategory->status==1?'checked':''}}>是
        <input type="radio" name="status" value="0"
                {{$shopscategory->status==0?'checked':''}}>否
        <br>
        <div class="form-group">
            <label>图片</label>
            <input type="file" name="img">
            <img src="{{$shopscategory->img()}}" alt=""  class="img-circle" width="100px" >
        </div>
        {{csrf_field()}}
        {{method_field('PATCH')}}
        <button class="btn btn-info">提交</button>
    </form>
@stop
