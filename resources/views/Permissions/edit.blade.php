@extends('default_admin')
@section('contents')
<div><h1 style="text-align: center;color: red;">修改权限</h1></div>
<form class="form-horizontal" action="{{route('permissions.update',[$permission->id])}}" method="post">
    @include('_errors')
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">权限名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" value="{{$permission->name}}">
        </div>
    </div>
    {{csrf_field()}}{{method_field('PATCH')}}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" class="btn btn-info">确认修改</button>
        </div>
    </div>
</form>
@stop