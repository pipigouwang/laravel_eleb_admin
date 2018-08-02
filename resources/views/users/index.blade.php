@extends('default_admin')

@section('contents')
    <table class="table table-bordered table-responsive">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            {{--<th>密码</th>--}}
            <th>邮箱</th>
            <th>头像</th>
            <th>所属商家</th>
            <th>是否启用</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name}}</td>
                {{--<td>{{ $user->password}}</td>--}}
                <td>{{ $user->email}}</td>
                <td><img class="img-circle" width="100px" src="{{ $user->head() }}" /></td>
                <td>{{$user->shopss->shop_name}}</td>
                <td>{{ $user->status?'使用':'禁用'}}</td>
                <td>
                    <a href="{{ route('users.edit',[$user])}}">编辑</a>
                    <form method="post" action="{{ route('users.destroy',[$user]) }}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-warning btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$users->appends(['keyword'=>$keyword])->links() }}
@endsection

