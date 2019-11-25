@extends('admin/common')

@section('title', '添加课程分类')

@section('body')
    <div class="container">
        <img src="/image/bee175ca64143831a1bf79c3e0a31ee3.jpg" width="1100" height="200" alt="">
        <form class="form-horizontal" action="{{url('admin/add_category_do')}}" method="post" >
            @csrf
            <div class="form-group">
                <br><br><br>
                <label for="inputEmail3" class="col-sm-2 control-label">分类名称：</label>
                <div class="col-sm-10 col-md-5">
                    <input type="text" name="cate_name" class="form-control" placeholder="请输入课程分类名称">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">分类级别：</label>

                <div class="col-sm-10  col-md-5">
                    <select class="form-control" name="pid">
                        <option value="0" selected>--顶级分类--</option>
                        @foreach($cate as $v)
                            <option value="{{$v['cate_id']}}"><?php echo str_repeat('&nbsp',$v['level']*2) ?>{{$v['cate_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>





            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Sign in</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('content')
    <p>This is my body content.</p>
@endsection
