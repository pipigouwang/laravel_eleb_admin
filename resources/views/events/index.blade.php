@extends('default_admin')
@section('contents')
    <div class="container">
        <h1>抽奖活动表</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>活动名称</th>
                <th>活动详情</th>
                <th>报名开始时间</th>
                <th>报名结束时间</th>
                <th>开奖日期</th>
                <th>报名人数限制</th>
                <th>是否开奖</th>
                <th colspan="2">操作</th>
            </tr>
            @foreach($events as $event)
                <tr class="tr">
                    <td>{{$event->id}}</td>
                    <td>{{$event->title}}</td>
                    <td>{{$event->content}}</td>
                    <td>{{date('Y-m-d',$event->signup_start)}}</td>
                    <td>{{date('Y-m-d',$event->signup_end)}}</td>
                    <td>{{date('Y-m-d',$event->prize_date)}}</td>
                    <td>{{$event->signup_num}}</td>
                    <td>{{$event->is_prize?'是':'否'}}</td>
                    <td><a href="{{route('events.edit',[$event])}}" class="btn btn-xs btn-primary">修改</a></td>
                    <td>
                        <form action="{{route('events.destroy',[$event])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-primary" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('events.create')}}" class="btn btn-xs btn-primary">添加</a></td>
            </tr>
        </table>
        {{--{{$navs->links()}}--}}
    </div>
@endsection
