@extends('default_shopcates')
@section('contents')
    <table class="table table-bordered table-responsive">
        <tr>
            <th>ID</th>
            <th>分类名</th>
            <th>分类图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shopscategories as $shops)
            <tr>
                <td>{{ $shops->id }}</td>
                <td>{{ $shops->name }}</td>
                <td align="center"><img class="img-circle" width="100px" src="{{$shops->img()}}" /></td>
                <td>{{ $shops->status?'是':'否'}}</td>
                <td>
                    删除
                    <a href="{{ route('shopscategory.edit',[$shops])}}"><button class="btn btn-warning btn-xs">编辑</button></a><br>
                    <form method="post" action="{{ route('shopscategory.destroy',[$shops])}}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$shopscategories->links()}}
@endsection

