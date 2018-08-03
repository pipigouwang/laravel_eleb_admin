@extends('default_admin')
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@stop
@section('js_files')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    {{--@include('vendor.ueditor.assets')--}}
@stop
@section('contents')
    <h2>修改抽奖活动奖品</h2>
    @include('_errors')
    <br>
    <br>
    <form action="{{route('eventprizes.update',[$eventprize])}}" method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>活动名称</td>
                <td>
                <select name="event_id" id="">
                    @foreach($events as $event);
                    <option  {{$event->id==$eventprize->event_id?'selected':''}}   value="{{$event->id}}">{{$event->title}}</option>
                    @endforeach
                </select>
                </td>
            </tr>
            <tr>
                <td>奖品名称</td>
                <td><input type="text" name="name" class="form-control" value="{{$eventprize->name}}" placeholder="必填"></td>
            </tr>
            <tr>
                <td>奖品详情</td>
                <td>
                    <textarea name="description">{{$eventprize->description}} </textarea>
                </td>
            </tr>
            <tr>
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <td></td>
                <td><button type="submit" class="btn btn-primary">提交</button></td>
            </tr>

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