@extends('admin/common')
@section('body')
    <br> <br> <br>
    <h3 style="color:grey">添加题库：</h3><br>
    <h4>
        <button id="button" class="btn btn-primary">返回</button>&nbsp
    </h4>&nbsp
    <div align="center">
        <button type="button" class="btn btn-primary dan">单选题</button>
        <button type="button" class="btn btn-success dou">多选题</button>
        <button type="button" class="btn btn-info pan">判断题</button>
    </div>
    <form action="{{url('info/bank_add')}}" method="post">
        <input type="hidden" name="type" value="1">
        <input type="hidden" name="cate_id" value="{{$cate_id}}">
        @csrf
    <div class="container" id="one">&nbsp
            <table align="center">
                <tr>
                    <td>问题：</td>
                    <td><input type="text" name="problem"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="radio" name="pro_text[]" value="1">A
                        <span><input type="text" name="tex[]"></span><br>
                        <input type="radio" name="pro_text[]" value="2">B
                        <span><input type="text" name="tex[]"></span><br>
                        <input type="radio" name="pro_text[]" value="3">C
                        <span><input type="text" name="tex[]"></span><br>
                        <input type="radio" name="pro_text[]" value="4">D
                        <span><input type="text" name="tex[]"></span>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="提交"></td>
                </tr>
            </table>
        </div>
    </form>
    <form action="{{url('info/bank_add')}}" method="post">
        <input type="hidden" name="type" value="2">
        <input type="hidden" name="cate_id" value="{{$cate_id}}">
        @csrf
        <div class="container" id="two">&nbsp
            <table align="center">
                <tr>
                    <td>问题：</td>
                    <td><input type="text" name="problem"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="checkbox" name="pro_text[]" value="1">A
                        <span><input type="text" name="tex[]"></span><br>
                        <input type="checkbox" name="pro_text[]" value="2">B
                        <span><input type="text" name="tex[]"></span><br>
                        <input type="checkbox" name="pro_text[]" value="3">C
                        <span><input type="text" name="tex[]"></span><br>
                        <input type="checkbox" name="pro_text[]" value="4">D
                        <span><input type="text" name="tex[]"></span>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="提交"></td>
                </tr>
            </table>
        </div>
    </form>
    <form action="{{url('info/bank_add')}}" method="post">
        <input type="hidden" name="cate_id" value="{{$cate_id}}">
        <input type="hidden" name="type" value="3">
        @csrf
        <div class="container" id="three">&nbsp
            <table align="center">
                <tr>
                    <td>问题：</td>
                    <td><input type="text" name="problem"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="radio" name="pro_text" value="1">对
                        <input type="radio" name="pro_text" value="2">错
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="提交"></td>
                </tr>
            </table>
        </div>
    </form>
    <script src="/admin/js/jquery.min.js"></script>
    <script>

        $(function() {
            $("#one").hide();
            $("#two").hide();
            $("#three").hide();
            $('.dan').click(function(){
                var dan=$('#one').show();
                var dou=$('#two').hide();
                var pan=$('#three').hide();
            })
            $('.dou').click(function(){
                var dan=$('#one').hide();
                var pan=$('#three').hide();
                var dou=$('#two').show();
            })
            $('.pan').click(function(){
                var dan=$('#one').hide();
                var dou=$('#two').hide();
                var pan=$('#three').show();
            })
        });
    </script>
    <script>
        $('#button').click(function(){
            window.history.go(-1);
        })
    </script>
@endsection











