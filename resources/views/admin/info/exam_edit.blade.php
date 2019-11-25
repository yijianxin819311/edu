@extends('/admin/common')
@section('body')
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div style="width: 600px;height: 50">

        <form action="{{url('exam/exam_update')}}" method="post" class="form-inline" id="myform" >
            <input type="hidden" name="exam_id" value="{{$data->exam_id}}">
            @csrf
            <div class="form-group">
                <label for="exampleInputName2">考试指导标题</label>
                <input type="text" name="exam_title" value="{{$data->exam_title}}" class="form-control" id="name">
                <span id="sp"></span>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail2">考试指导内容</label>
                {{--                <textarea name="infor_content" id="" class="form-control" cols="45" rows="5"></textarea>--}}
                <textarea  name="exam_content" id="info"   >{{$data->exam_content}}</textarea>
            </div>

            <input type="submit" class="btn btn-primary block full-width m-b" id="sub" value="修改">
        </form>

    </div>

</div>
@endsection
<script src="/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('/UEditor/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/ueditor.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/lang/zh-cn/zh-cn.js')}}"></script>
@section('script')
<script>
    var ue = UE.getEditor('info');
</script>
@endsection

