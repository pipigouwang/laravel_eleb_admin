@extends('default_admin')
@section('contents')
    <div class="container">
        <h1>活动报名表</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>活动名称</th>
                <th>商家账号ID</th>
                <th colspan="2">操作</th>
            </tr>
            @foreach($eventusers as $eventuser)
                <tr class="tr">
                    <td>{{$eventuser->events->title}}</td>
                    <td>{{$eventuser->users->name}}</td>

                    <td> <td><a href="{{route('eventusers.store')}}" class="btn btn-xs btn-primary">点击报名</a></td>
                    </td>
                </tr>
            @endforeach
            {{--<tr>--}}
                {{--<td colspan="10"><a href="{{route('events.create')}}" class="btn btn-xs btn-primary">添加</a></td>--}}
            {{--</tr>--}}
        </table>
        {{--{{$navs->links()}}--}}
    </div>
@endsection
