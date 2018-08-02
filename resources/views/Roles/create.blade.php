@extends('default_admin')
@section('contents')
    <h2>添加角色</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>角色名称</td>
                <td>
                    <div class="from-group">
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="请输入">
                    </div>
                </td>
            </tr>
            <tr>
                <td>角色权限</td>
                <td>
                    <div class="from-group">
                            @foreach($permissions as $id=>$permission)
                                    <input type="checkbox" name="permission[]" value="{{$id}}"> {{$permission}}
                            @endforeach
                    </div>
                </td>

            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">提交</button></td>
            </tr>
            {{csrf_field()}}
        </table>
    </form>
    @stop