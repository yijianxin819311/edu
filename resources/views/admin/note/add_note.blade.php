@extends('admin/common')

@section('title', '笔记添加')

@section('body')


    <div class="container">&nbsp
        <h3 style="color:grey">笔记添加：</h3><br>
        <h4><button id="button" class="btn btn-primary">返回</button></h4>&nbsp
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>警告:</strong> {{$error}} </div>
            @endforeach
        @endif
        <form class="form-horizontal" action="{{url('admin/add_note_do')}}" method="post">
            @csrf
            <input type="hidden" name="cou_id" value="{{$cou_id}}">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">笔记内容：</label>
                <button type="button" class="btn btn-warning button">收起</button>
                <div class="col-sm-10 col-md-5" id="show">
                    <!-- 加载编辑器的容器 -->

                    <script id="container" name="note_desc" type="text/plain" style="height:300px;"></script>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info" >添加</button>
                </div>
            </div>
        </form>

    </div>

@endsection
<script type="text/javascript" src="{{asset('/UEditor/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/ueditor.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/lang/zh-cn/zh-cn.js')}}"></script>
<script src="{{asset('/app/admin/js/jquery.min.js?v=2.1.4')}}"></script>
@section('script')
    <script>

        $('#button').click(function(){
            window.history.go(-1);
        })
    </script>
    <script>
        var ue = UE.getEditor('container');

        $('.button').click(function(){

            if($(this).text()=='收起'){
                $('#show').addClass('hide');
                $(this).text('放下');
            }else{
                $('#show').removeClass('hide');
                $(this).text('收起');
            }

        });
    </script>

@endsection
