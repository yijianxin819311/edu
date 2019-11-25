@extends('/admin/common')
@section('body')
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <form class="form-inline">

            <div class="form-group">
                <label for="exampleInputEmail2">资讯标题</label>
                <input type="text" name="infor_title" id=""style="width: 600px;height: 50px;" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail2">资讯内容</label>
                <textarea  name="infor_content" id="info"   style="width: 600px;height: 150px;"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" id="sub" style="width: 600px;height: 50px;" value="资讯添加">
            </div>
        </form>
    </div>
</div>
@endsection
<script type="text/javascript" src="{{asset('/UEditor/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/ueditor.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/lang/zh-cn/zh-cn.js')}}"></script>
<script src="/admin/js/jquery.min.js"></script>
<script>
    var ue = UE.getEditor('info');
    //alert(22);
$(function(){
    $('#sub').on('click',function(){
//        alert(11);
        var infor_title=$('[name="infor_title"]').val();

        var infor_content=$('[name="infor_content"]').val();
        //alert(u_email);
        $.ajax({
            url:'info_add_do',
            dataType : "json",
            data:{infor_title:infor_title,infor_content:infor_content},
            success:function(res){
                if(res.code==201){
                    alert(res.msg);
                }
                if(res.code==200){
                    alert(res.msg);
                    location.href="info_list";
                }
            }
        });
        return false;
    })
})
</script>
