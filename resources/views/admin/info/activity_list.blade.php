@extends('/admin/common')
@section('body')
<div class="table-responsive">
    <center>
        <h3>活动列表</h3>

    <form action="">
        活动标题：<input type="text" name="name" value="{{$name}}">
        <input type="submit" value="搜索">
    </form>
    </center>
    <table class="table table-condensed" >
        <tr class="active">
            <td >活动编号</td>
            <td >活动标题</td>
            <td >活动内容</td>
        </tr>
        @foreach($res as $v)
            <tr class="active">
                <td >{{$v->act_id}}</td>
                <td >{{$v->act_title}}</td>
                <td >{{strip_tags($v->act_content)}}</td>
            </tr>

        @endforeach

    </table>
    {{ $res->appends(['name'=>$name])->links()}}
</div>
@endsection
