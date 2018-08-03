@extends('default_admin')
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    @stop
@section('js_files')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    {{--@include('vendor.ueditor.assets')--}}
    @stop
@section('contents')
    <h2>发布抽奖活动</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('events.store')}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>名称</td>
                <td><input type="text" name="title" class="form-control" value="" placeholder="必填"></td>
            </tr>
            <tr>
                <td>活动详情</td>
                <td>
                    {{--<script id="container" name="content" type="text/plain"></script>--}}
                    <textarea name="content"> </textarea>
                </td>
            </tr>
            <tr>
                <td>报名开始时间</td>
                <td>
                    <input type="date" name="signup_start">
                </td>
            </tr>
            <tr>
                <td>报名结束时间</td>
                <td>
                    <input type="date" name="signup_end">
                </td>
            </tr>
            <tr>
                <td>开奖时间</td>
                <td>
                    <input type="date" name="prize_date">
                </td>
            </tr>
            <tr>
                <td>报名人数限制</td>
                <td>
                    <input type="text" name="signup_num">
                </td>
            </tr>
            <tr>
                <td>是否开奖</td>
                <td>
                    <input type="radio" name="is_prize"  value="1">:是<br>
                    <input type="radio" name="is_prize"  value="0">:否
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="btn btn-primary">提交</button></td>
            </tr>
            {{csrf_field()}}
        </table>
    </form>
    @stop
@section('js')
    <script>
    // 初始化Web Uploader
    var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,

    // swf文件路径
   // swf: BASE_URL + '/js/Uploader.swf',

    // 文件接收服务端。
    server: "{{route('upload')}}",

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#filePicker',
    // 只允许选择图片文件。
    accept: {
    title: 'Images',
    extensions: 'gif,jpg,jpeg,bmp,png',
    mimeTypes: 'image/jpg,image/jpeg,image/png,image/gif,image/bmp'
    },
        formData:{
            _token:'{{ csrf_token() }}'
        }
    });
    uploader.on( 'uploadSuccess', function( file,response ) {
        // do some things.
        //response.fileName
        //console.log(response);
        $("#img").attr('src',response.fileName);
        $("#img_url").val(response.fileName);
    });
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
    </script>
    @stop