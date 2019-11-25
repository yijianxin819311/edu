@extends('/admin/common')
@section('body')
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>

        <form class="form-inline" action="{{url('info/info_update')}}" method="post">
            @csrf
            <input type="hidden" name="infor_id" value="{{$data->infor_id}}">
            <div class="form-group">
                <label for="exampleInputEmail2">资讯标题</label>
                <input type="text" name="infor_title" value="{{$data->infor_title}}" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail2">资讯内容</label>
                <textarea name="infor_content" id="info">{{$data->infor_content}}</textarea>
            </div>
            <input type="submit" class="btn btn-primary block full-width m-b" value="修改">


        </form>
    </div>
</div>
@endsection
<script type="text/javascript" src="{{asset('/UEditor/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/ueditor.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/lang/zh-cn/zh-cn.js')}}"></script>
@section('script')
<script>
    var ue = UE.getEditor('info');
</script>
@endsection

