@extends('admin/common')

@section('title', '修改课程分类')

@section('body')
    <div class="container">
        <img src="/image/bee175ca64143831a1bf79c3e0a31ee3.jpg" width="1100" height="200" alt=""> <br>
        <h3>课程分类修改</h3>
        <form class="form-horizontal" action="{{url('admin/update_category_first_do')}}" method="post" >
            @csrf
            <input type="hidden" name="cate_id" value="{{$cate['cate_id']}}">
            <div class="form-group">
                <br><br><br>
                <label for="inputEmail3" class="col-sm-2 control-label">分类名称：</label>
                <div class="col-sm-10 col-md-5">
                    <input type="text" name="cate_name" value="{{$cate['cate_name']}}" class="form-control" placeholder="请输入课程分类名称">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">修改</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')

@endsection
