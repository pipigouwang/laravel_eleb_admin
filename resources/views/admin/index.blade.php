@extends('default_admin')
@section('contents')
    <table class="table table-bordered table-responsive">
        <tr>
            <td>ID</td>
            <td>姓名</td>
            <td>邮箱</td>
            <td>密码</td>
            <td>操作</td>
        </tr>
        @foreach($admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td>{{$admin->email}}</td>
            <td>{{$admin->password}}</td>
            <td>
                <a href="{{route('admin.edit',[$admin])}}">编辑</a>
                <form method="post" action="{{ route('admin.destroy',[$admin])}}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-xs">删除</button>
                </form>
            </td>
        </tr>
        @endforeach
        <button><a href="{{route('admin.create')}}">添加</a></button>
    </table>
    @endsection
