@extends('admin/common')
@section('body')
    <div class="table-responsive">
        <center>
            <h3>题库列表</h3>
        </center>

        <table class="table table-condensed" >
            <tr class="active">
                <td >问题ID</td>
                <td >正确答案</td>
                <td>操作</td>
            </tr>
                <tr >
                    <td>{{$data->bank_id}}</td>
                    <td >{{$data->pro_text}}</td>
                    <td>
                        <a href="{{url('info/bank_xiang_edit')}}?bank_id={{$data->bank_id}}" class="btn btn-warning">修改</a>
                    </td>
                </tr>
        </table>
    </div>
@endsection