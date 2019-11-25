@extends('/admin/common')
@section('body')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>教师出题</title>
</head>
<body>
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div style="width: 600px;height: 50">

    <form action="" method="post" class="form-inline" id="myform" >
        @csrf
        <div class="form-group">
            <label for="exampleInputName2">考试指导标题</label>
            <input type="text" name="exam_title" class="form-control" id="name">
            <span id="sp"></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail2">考试指导内容</label>
            <textarea  name="exam_content" id="goods" ></textarea>
        </div>

        <input type="submit" class="btn btn-primary block full-width m-b" id="sub" value="添加">
    </form>

</div>
</div>
</body>
</html>
@endsection
<script type="text/javascript" src="{{asset('/UEditor/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/ueditor.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/lang/zh-cn/zh-cn.js')}}"></script>
@section('script')
    <script>
        var ue = UE.getEditor('goods');
        $(function () {
            $('#myform').submit(function () {

                var data = $('#myform').serialize();
                //alert(data);
                $.post("{{url('exam/exam_add_do')}}", data, function (res) {
                    alert(res.msg);
                    if(res.code==200){
                        location.href='exam_list';
                    }
                }, 'json');
                return false;
            });
        })

    </script>
@endsection