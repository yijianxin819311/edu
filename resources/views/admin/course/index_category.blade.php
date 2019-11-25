@extends('admin/common')

@section('title', '课程列表')

@section('body')
<div class="container"><br><br>
    <h3 style="color: grey">课程分类：</h3><br><br>
    <form class="form-inline" action="{{url('admin/index_category')}}">
        <div class="form-group">
            <label for="exampleInputName2">分类名称：</label>
            <input type="text" name="cate_name" value="{{$cate_name}}" class="form-control" id="exampleInputName2" placeholder="请输入分类名称">
        </div>&nbsp
        <button type="submit" class="btn btn-info">查询</button>
    </form>
    <table class="table table-hover">
        <tr>
        <th>序号</th>
        <th>分类名称</th>
        <th>层级显示</th>
        <th>操作</th>
        </tr>
            @foreach($cate as $k => $v)

            <tr  cate_id="{{$v['cate_id']}}" pid="{{$v['pid']}}"  class="info">
            <td>{{$k+1}}</td>
            <td fieid="cate_name">
                 <span class="span">{{$v['cate_name']}}</span>
                  <input type="text" value="{{$v['cate_name']}}" style="display:none;">
            </td>
            <td>{{$v['pid']==0?'一级分类':'二级分类'}}</td>
            <td>
                <a href="{{url('admin/list_category')}}?cate_id={{$v['cate_id']}}" class="btn btn-success">查看详情</a>&nbsp
                <a href="{{url('admin/update_category')}}?cate_id={{$v['cate_id']}}" class="btn btn-info">编辑课程</a>&nbsp&nbsp
                <a href="{{url('admin/delete_category')}}?cate_id={{$v['cate_id']}}" class="btn btn-default btn-danger">删除</a>
            </td>
            </tr>
            @endforeach
        <tr>
            <td colspan="6" align="center">
                {{ $cate->links() }}
            </td>
        </tr>
    </table>
</div>

@endsection

@section('script')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function(){
            $('.span').click(function(){
                // alert(11);
                var _this=$(this);
                _this.hide();
                _this.next('[type="text"]').show();

            });
            $('[type="text"]').blur(function(){
                // alert(22);
                var _this=$(this);
                var value=_this.val();
                var fieid=_this.parent('td').attr('fieid');
                var cate_id=_this.parents('tr').attr('cate_id');

                // console.log(cate_id);
                var data={value:value,fieid:fieid,cate_id:cate_id};
                // console.log(data);
                $.post("ajax_update",data,function(res){
                        _this.hide();
                        _this.prev('span').text(value).show();
                });
            });
        });
    </script>
@endsection
