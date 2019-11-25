<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">h</h1>

        </div>
        <h3>欢迎使用 hAdmin</h3>

        <form class="m-t" role="form">
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="u_email" placeholder="用户名" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="u_pwd" placeholder="密码" required="">
            </div>
            <div class="form-group">

            </div>
            <button type="submit" class="btn btn-primary block full-width m-b" id="sub">登 录</button>


            <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
            </p>

        </form>
    </div>
</div>

<!-- 全局js -->
<script src="/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/admin/js/bootstrap.min.js?v=3.3.6"></script>
</body>
</html>
<script src="/admin/js/jquery.min.js"></script>
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#sub').click(function(){
            var u_email=$('#u_email').val();
            var u_pwd=$('#u_pwd').val();
            $.ajax({
                url:'loginHandel',
                type:'post',
                data:{u_email:u_email,u_pwd:u_pwd},
                dataType:'json',
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                        window.location.href='/admin/common';
                    }else{
                        alert(res.msg);
                    }
                }
            });
            return false;
        })
    });
</script>
