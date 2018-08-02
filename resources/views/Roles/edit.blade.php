@extends('default_admin')
@section('contents')
<div><h1 style="text-align: center;color: red;">修改角色</h1></div>
<form class="form-horizontal" action="{{route('roles.update',[$role->id])}}" method="post">
    @include('_errors')
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">角色名</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" value="{{$role->name}}">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">角色权限</label>
        <div class="col-sm-10">
            <div class="col-sm-10">
                @foreach($permissions as $id=>$permission)
                    <label class="checkbox-inline">
                        <input type="checkbox" name="permission[]" value=" {{$id}}" {{$role->hasPermissionTo($permission)?'checked':''}}>{{$permission}}
                    </label>
                @endforeach
            </div>
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