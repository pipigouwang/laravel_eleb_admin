@extends('default_admin')
@section('contents')
    <table class="table table-bordered table-responsive">
        <tr>
            <th>ID</th>
            <th>店铺分类ID</th>
            <th>名称</th>
            <th>店铺图片</th>
            <th>评分</th>
            <th>是否是品牌</th>
            <th>是否准时送达</th>
            <th>是否蜂鸟</th>
            <th>是否保标记</th>
            <th>是否票标记</th>
            <th>是否准标记</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>店公告</th>
            <th>优惠信息</th>
            <th>状态:1正常,0待审核,-1禁用</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{ $shop->id}}</td>
                <td>{{$shop->shopscate->name}}</td>
                <td>{{$shop->shop_name}}</td>
                <td align="center"><img class="img-circle" width="100px" src="{{$shop->shop_img()}}" /></td>
                <td>{{$shop->shop_rating}}</td>
                <td>{{$shop->brand?'是':'否'}}</td>
                <td>{{$shop->on_time?'是':'否'}}</td>
                <td>{{$shop->fengniao?'是':'否'}}</td>
                <td>{{$shop->bao?'是':'否'}}</td>
                <td>{{$shop->piao?'是':'否'}}</td>
                <td>{{$shop->zhun?'是':'否'}}</td>
                <td>{{$shop->start_send}}</td>
                <td>{{$shop->send_cost}}</td>
                <td>{{$shop->notice}}</td>
                <td>{{$shop->discount}}</td>
                <td>@if($shop->status==1)正常@elseif($shop->status==0)待审核@else禁用@endif</td>
                <td>
                    <a href="{{ route('shops.info',[$shop])}}"><button class="btn btn-warning btn-xs">审核是否通过</button></a><br>
                    <a href="{{ route('shops.edit',[$shop])}}"><button class="btn btn-warning btn-xs">编辑</button></a><br>
                    <form method="post" action="{{ route('shops.destroy',[$shop])}}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{$shops->links()}}
@endsection

