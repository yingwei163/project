<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>邮件确认</title>
</head>
<body>
        <h1>你好，请确认你的邮件</h1>
        <a href="{{url('/home/user/verify/'.$confirmed_code)}}">点击确认</a>
</body>
</html>