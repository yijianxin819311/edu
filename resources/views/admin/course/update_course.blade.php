@extends('admin/common')

@section('title', '修改课程信息')

@section('body')
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{asset('UEditor/utf8-php/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('UEditor/utf8-php/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
    <div class="container">
    <div class="container">
        <br>
        <h3 style="color: grey">编辑课程信息:</h3>

        <form class="form-horizontal" action="{{url('admin/update_course_do')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="cou_id" value="{{$course['cou_id']}}">
            @csrf

            <div class="form-group">
                <br><br>
                <label for="inputEmail3" class="col-sm-2 control-label">课程名称：</label>
                <div class="col-sm-10 col-md-5">
                    <input type="text" name="cou_name" value="{{$course['cou_name']}}" class="form-control" placeholder="请输入课程分类名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">课程分类：</label>
                <div class="col-sm-10  col-md-5">
                    <select class="form-control" name="cate_id">
                        <option value="" selected>--请选择分类--</option>
                         @foreach($category as $v)
                         <option value="{{$v['cate_id']}}" {{$v['cate_id']==$course['cate_id']?'selected':''}}>{{$v['cate_name']}}</option>
                         @endforeach
                    </select>
                </div>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="inputEmail3" class="col-sm-2 control-label">讲师选择：</label>--}}
{{--                <div class="col-sm-10  col-md-5">--}}
{{--                    <select class="form-control" name="Lect_id">--}}
{{--                        <option value="" selected>--请选择讲师--</option>--}}
{{--                        @foreach($lect as $v)--}}
{{--                            <option value="{{$v['lect_id']}}" {{$v['lect_id']==$course['lect_id']?'selected':''}}>{{$v['lect_name']}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">课程状态：</label>
                <div class="col-sm-10  col-md-5">
                    <label class="radio-inline">
                        <input type="radio" name="cou_status" id="inlineRadio1" {{$course['cou_status']==1?'checked':''}} value="1"> 未开始
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="cou_status" id="inlineRadio2" {{$course['cou_status']==2?'checked':''}} value="2"> 连载中
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="cou_status" id="inlineRadio3" {{$course['cou_status']==3?'checked':''}} value="3"> 已完结
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">总课时：</label>
                <div class="col-sm-10 col-md-5">
                    <input type="text" name="total_course_time" value="{{$course['total_course_time']}}" class="form-control" placeholder="请输入总课时，按分算">
                </div>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>警告:</strong> {{$error}} </div>
                @endforeach
            @endif
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">课程图片：</label>
                <input type="file" name="img" id="exampleInputFile"><img src="{{$url.'/storage/'.$course['img']}}" width="70" alt="">
                <input type="hidden" name="img" value="{{$course['img']}}">
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">是否免费：</label>
                <div class="col-sm-10  col-md-5">
                    <label class="radio-inline">
                        <input type="radio" name="is_free" id="inlineRadio1" {{$course['is_free']==1?'checked':''}} value="1"> 是
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="is_free" id="inlineRadio2" {{$course['is_free']==2?'checked':''}} value="2"> 否
                    </label>
                </div>
            </div>
            <div class="form-group" id="hide" cou_id="{{$course['is_free']}}">
                <label for="inputEmail3" class="col-sm-2 control-label">价格：</label>
                <div class="col-sm-10 col-md-5">
                    <input type="text" name="price" class="form-control" value="0">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">介绍：</label>
                <button type="button" class="btn btn-warning button">收起</button>
                <div class="col-sm-10 col-md-5" id="show">
                    <!-- 加载编辑器的容器 -->
                    <script id="container" name="presentation" type="text/plain" style="height:100px;">{{strip_tags($course['presentation'])}}</script>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-success" value="修改">
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>
            $(function(){
                if($('#hide').attr('cou_id')==1){
                    $('#hide').hide();
                }
            $('[name="is_free"]').click(function(){
                var value=$(this).val();
                if(value==2){
                    // alert(3);
                    $('#hide').show();
                }else{
                    $('#hide').hide();
                }
            })
        })
    </script>
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
