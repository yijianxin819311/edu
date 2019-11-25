@extends('admin/common')

@section('title', '章节添加')

@section('body')
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{asset('UEditor/utf8-php/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('UEditor/utf8-php/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
    <div class="container">&nbsp
        <img src="/image/685c7de3c069cc3d3331ff2ca45b9385.jpg" height="100" width="1200" alt="">&nbsp
        <h3 style="color: grey">添加章节：</h3>&nbsp&nbsp&nbsp
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>警告:</strong> {{$error}} </div>
            @endforeach
        @endif
        <form class="form-horizontal" action="{{url('admin/add_catalog_do')}}" method="post" >
            @csrf
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">课程：</label>
                <div class="col-sm-10  col-md-5">
                    <input type="hidden" name="cou_id" value="{{$cou_id}}">
                    <input type="text" readonly value="{{$course['cou_name']}}" class="form-control" placeholder="请输入章节名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">章节名称：</label>
                <div class="col-sm-10 col-md-5">
                    <input type="text" name="catelog_name" class="form-control" placeholder="请输入章节名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-10 col-md-5">
                    <input type="text" name="catalog_head" class="form-control" placeholder="请输入章节名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">是否免费：</label>
                <div class="col-sm-10  col-md-5">
                    <label class="radio-inline">
                        <input type="radio" name="is_free" id="inlineRadio1" checked value="1"> 是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="is_free" id="inlineRadio2" value="2"> 否
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">描述：</label>
                <button type="button" class="btn btn-warning button">收起</button>
                <div class="col-sm-10 col-md-5" id="show">
                    <!-- 加载编辑器的容器 -->
                    <script id="container" name="catalog_describe" type="text/plain" style="height:100px;"></script>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">提交</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>
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
