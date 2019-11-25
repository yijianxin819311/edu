@extends('/admin/common')
@section('body')
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>

            <form class="form-inline" action="{{url('info/bank_xiang_update')}}" method="post">
                @csrf
                <input type="hidden" name="bank_id" value="{{$data->bank_id}}">
                <div class="form-group">
                    <label for="exampleInputEmail2">正确答案</label>
                    <input type="text" name="pro_text" value="{{$data->pro_text}}" id="" class="form-control">
                </div>
                <input type="submit" class="btn btn-primary block full-width m-b" value="修改">
            </form>
        </div>
    </div>
@endsection


