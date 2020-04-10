<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>- 修改密码 -</title>
</head>
<body>
    <h1><b>h</b></h1>

    <form action="{{url('modifydo')}}">
        <table border="2">
            <tr>
                <td>新密码</td>
                <td><input type="password" name="pass1"></td>
            </tr>
            <tr>
                <td>确认新密码</td>
                <td><input type="password" name="pass2"></td>
            </tr>
            <tr>
                <td>→</td>
                <td><input type="submit" value="修改"></td>
            </tr>
        </table>
    </form>
</body>
</html>