@extends('default_shopcates')
@section('contents')
<h1>添加分类</h1>
@include('_errors')
<form method="post" action="{{route('shopscategory.store')}}" enctype="multipart/form-data">
    <div class="form-group">
    商品分类名称: <input type="text" name="name" value="{{old('name')}}"><br>
        <div class="form-group">
            <label>商品分类图</label>
            <input type="file" name="img">
        </div>
        是否上架: <input type="radio" name="status" value="1">是
        <input type="radio" name="status" value="0">否
        <br>
    <button type="submit" class="btn btn-info" >提交</button>
    {{csrf_field()}}
    </div>
</form>
@endsection