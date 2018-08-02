@extends('default_admin')
@section('contents')
    <div><h1 style="text-align: center;color: red;">权限列表</h1></div>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>ID</th>
            <th>权限名</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->created_at}}</td>
                <td>
                    <form action="{{route('permissions.destroy',[$permission->id])}}" method="post">
                        <a type="button" class="btn btn-success" aria-label="Left Align"  href="{{route('permissions.edit',[$permission->id])}}">
                            修改
                        </a>
                        {{csrf_field()}}{{method_field('DELETE')}}<button type="submit" class="btn btn-danger" aria-label="Left Align">
                            删除
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        <td colspan="6" style="text-align: center"><a type="button" class="btn btn-info btn-lg" aria-label="Left Align" href="{{route('permissions.create')}}">
                添加
            </a></td>
    </table>
    {{$permissions->links()}}
@stop
