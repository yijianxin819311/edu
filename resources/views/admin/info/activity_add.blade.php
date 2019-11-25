@extends('/admin/common')
@section('body')
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <form class="form-inline">

            <div class="form-group">
                <label for="exampleInputEmail2">活动标题</label>
                <input type="text" name="act_title" id="" style="width: 600px;height: 50px;" class="form-control">


            </div>
            <div class="form-group">
                <label for="exampleInputEmail2">活动内容</label>
{{--                <textarea name="infor_content" id="" class="form-control" cols="45" rows="5"></textarea>--}}
                <textarea  name="act_content" id="goods_intro" style="width: 600px;height: 150px;" ></textarea>
            </div>

            <div class="form-group" style="color: grey">
            <button type="button" class=" btn form-control" style="width: 600px;height: 50px;">活动添加</button>
            </div>
        </form>
    </div>
</div>
@endsection
<script type="text/javascript" src="{{asset('/UEditor/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/ueditor.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/UEditor/lang/zh-cn/zh-cn.js')}}"></script>
@section('script')
<script>
    var ue = UE.getEditor('goods_intro');
    //alert(22);
    $(function () {
        $('.btn').on('click',function(){
            //alert(11);
            var act_title=$('[name="act_title"]').val();

            var act_content=$('[name="act_content"]').val();
            //alert(u_email);
            $.ajax({
                url:'activity_add_do',
                dataType : "json",
                data:{act_title:act_title,act_content:act_content},
                success:function(res){
                    if(res.code==201){
                        alert(res.msg);
                    }
                    if(res.code==200){
                        alert(res.msg);
                        location.href="activity_list";
                    }
                }
            })
        })
    })
</script>
@endsection

