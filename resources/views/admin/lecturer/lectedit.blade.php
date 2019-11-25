@extends('admin/common')
@section('title','讲师')
@section('body')
    <div class="container">&nbsp
<form action="{{url('/admin/lecturer/lectUpdate')}}" method="post">
    @csrf
    <table class="table table-hover">
    <input type="hidden" name="lect_id" value="{{$data->lect_id}}">
    <div class="form-group">
        <label for="exampleInputEmail1">讲师名称：</label>
        <input type="text" class="form-control" name="lect_name"  disabled="disabled" value="{{$data->lect_name}}" placeholder="名称">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">讲师个人简历：</label>
        <input type="text" class="form-control" name="lect_resume" value="{{$data->lect_resume}}" placeholder="讲师个人简历">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">讲师授课风格：</label>
        <input type="text" class="form-control" name="lect_style" value="{{$data->lect_style}}" placeholder="讲师授课风格">
    </div>
    <button type="submit" class="btn btn-default">修改</button>
    </table>
</form>
    </div>
@endsection
