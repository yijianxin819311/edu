@extends('admin/common')
@section('body')
    <div class="container">&nbsp
        <h3 style="color: grey">修改作业：</h3>&nbsp&nbsp
<form action="{{url('/admin/job/update')}}" method="post">
    @csrf
    <input type="hidden" name="job_id" value="{{$data->job_id}}">
    <div class="form-group">
        <label for="exampleInputEmail1">作业内容：</label>
        <input type="text" class="form-control" name="job_name" value="{{$data->job_name}}"  placeholder="名称">
    </div>
    <button type="submit" class="btn btn-default">修改</button>
</form>
    </div>

@endsection
@section('script')
    <script>
        $(function(){

        })
    </script>
@endsection
