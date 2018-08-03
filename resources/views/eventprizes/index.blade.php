@extends('default_admin')
@section('contents')
    <div class="container">
        <h1>抽奖活动奖品表</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>活动ID</th>
                <th>奖品名称</th>
                <th>奖品详情</th>
                {{--<th>中奖商家ID账号</th>--}}
                <th colspan="2">操作</th>
            </tr>
            @foreach($eventprizes as $eventprize)
                <tr class="tr">
                    <td>{{$eventprize->id}}</td>
                    <td>{{$eventprize->events->title}}</td>
                    <td>{{$eventprize->name}}</td>
                    <td>{{$eventprize->description}}</td>
                    {{--<td>{{$eventprize->users->name}}</td>--}}
                    {{--<td>{{date('Y-m-d',$event->signup_start)}}</td>--}}
                    {{--<td>{{date('Y-m-d',$event->signup_end)}}</td>--}}
                    {{--<td>{{date('Y-m-d',$event->prize_date)}}</td>--}}
                    {{--<td>{{$event->signup_num}}</td>--}}
                    {{--<td>{{$event->is_prize?'是':'否'}}</td>--}}
                    <td><a href="{{route('eventprizes.edit',[$eventprize])}}" class="btn btn-xs btn-primary">修改</a></td>
                    <td>
                        <form action="{{route('eventprizes.destroy',[$eventprize])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-primary" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('eventprizes.create')}}" class="btn btn-xs btn-primary">添加</a></td>
            </tr>
        </table>
        {{--{{$navs->links()}}--}}
    </div>
@endsection
