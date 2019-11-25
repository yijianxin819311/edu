@extends('admin/common')
@section('body')
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/admin/last/jobAddHandel" method="post">
    @csrf
    <input type="hidden" name="catalog_id" value="{{$catalog_id}}">
    <div class="form-group">
        <label for="exampleInputEmail1">添加作业：</label>
        <input type="text" class="form-control" name="Job_name" placeholder="名称">
    </div>
    <button type="submit" class="btn btn-default">提交</button>
</form>
</body>
</html>
@endsection
