@extends('default_admin')
@section('contents')
    {{--<div><h1 style="text-align: center;color: red;">会员列表</h1></div>--}}
    {{--<form class="navbar-form" style="padding-left: 0px;" method="get" action="{{route('member.index')}}">--}}
        {{--<div class="form-group navbar-right">--}}
            {{--<input type="text" class="form-control" placeholder="会员名" name="name">--}}
            {{--<input type="number" class="form-control" placeholder="电话号码" name="tel">--}}
            {{--<button type="submit" class="btn btn-default " style="width: 100px">搜索</button>--}}
        {{--</div>--}}
    {{--</form>--}}
    <br><br>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>ID</th>
            <th>会员名</th>
            <th>电话</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->username}}</td>
                <td>{{$value->tel}}</td>
                <td>{{$value->status?'正常':'禁用'}}</td>
                <td><a type="button" class="btn btn-info" aria-label="Left Align" href="">
                            会员详情
                        </a>
                    @if($value->status)
                        <a type="button" class="btn btn-danger" aria-label="Left Align"  href="{{route('members.able',[$value,'status'=>0])}}">
                            禁用会员
                        </a>
                        @else
                        <a type="button" class="btn btn-success" aria-label="Left Align"  href="{{route('members.able',[$value,'status'=>1])}}">
                            激活会员
                        </a>
                        @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{--<div style="text-align: center">{{$members->appends($data)->links()}}</div>--}}
@stop
