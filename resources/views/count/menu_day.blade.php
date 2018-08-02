@extends('default_admin')
@section('contents')
    <div class="container" style="margin-top: 10px;">
        @include('_errors')
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12" style="margin-bottom: 10px;">
                <h1 style="text-align: center">取所有商家菜品销量的前10位</h1>
                <form action="{{ route('MenuDay') }}" method="get" style="text-align: right;">
                    <input type="date" name="day" style="margin-right: 20px;">
                    <button type="submit" class="button btn-info">开始搜索</button>
                </form>
            </div>
            <div class="col-xs-12">
                <table class="table table-bordered">
                    <tr>
                        <th>菜品名1</th>
                        <th>所属商店2</th>
                        <th>{{ substr($time,0,4) }}年{{ substr($time,5,2) }}月{{ substr($time,-2) }}日销量</th>
                    </tr>
                    @foreach($day as $value)
                        <tr>
                            <td>{{ $value->goods_name }}</td>
                            <td>{{ $value->shop_name }}</td>
                            <td>{{ $value->sum }}&nbsp;份</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div style="text-align: center;">
                    <a href="{{ route('CountMenu') }}" class="btn btn-primary btn-lg" style="width: 200px;">返回</a>
                </div>
            </div>
        </div>
    </div>
@stop
