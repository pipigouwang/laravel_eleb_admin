@extends('default_admin')
@section('contents')
<div class="col-lg-2">
    <form action="{{ route('activities.index') }}" method="get">
        <div class="input-group">
            <select class="form-control" name="status">
                <option value="">全部</option>
                <option value="1" >已过期</option>
                <option value="2">进行中</option>
                <option value="3">未开始</option>
            </select>
            <span class="input-group-btn">
        <button class="btn btn-default" type="submit">确认</button>
                </span>
        </div>
    </form>
</div>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activities as $activity)
            <tr>
                <td>{{$activity->id}}</td>
                <td>{{$activity->title}}</td>
                <td>{{date('Y-m-d',$activity->start_time)}}</td>
                <td>{{date('Y-m-d',$activity->end_time)}}</td>
                <td>
                    <div class="row">
                        <div class="col-xs-2">
                            <a href="{{route('activities.show',[$activity])}}" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
                        </div>
            <div class="col-xs-2" style="margin-left: 5px">
                            <a href="{{route('activities.edit',[$activity])}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                        </div>
                        <div class="col-xs-2" style="margin-left: 5px">
                            <form action="{{route('activities.destroy',[$activity])}}" method="post">
                                <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            </form>
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</td>--}}
            {{--</tr>--}}
        @endforeach
    </table>
    <a href="{{route('activities.create')}}"><button>添加</button></a>
    {{$activities->links()}}
@endsection

