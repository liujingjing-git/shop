<!DOCTYPE html>
<html>

<head>
    <!-- <base href="/admin"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> -登录-</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/admin/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">h</h1>

            </div>
            <h3>欢迎登录</h3>

            <form class="m-t" role="form" action="{{url('logindo')}}" method="post">
                @csrf
            <table border="2">
                <tr>
                    <td>用户名:</td>
                    <td><input type="text" class="form-control" placeholder="用户名" required="" name="user_name"></td>
                </tr>
                <tr>
                    <td>密码:</td>
                    <td><input type="password" class="form-control" placeholder="密码" required="" name="pass"></td>
                </tr>
                <tr>
                    <td>→</td>
                    <td><input type="submit" value="登录"></td>
                </tr>
            </table>
                 <a href="">忘记密码了？</a> |
                 <a href="{{url('reg')}}">还没有账号? 前去注册</a> 
        </form>
</body>

</html>