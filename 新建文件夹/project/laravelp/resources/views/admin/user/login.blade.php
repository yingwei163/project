<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/admin/login.css">
    <title>Document</title>
</head>
<body>
    <div class="header" id="header">
        <div class="h_title">
               <p class="title-x">欢迎进入后台</p>
        </div>
    </div>
    <div class="container">
       <div class="row">
           <div class="col-md-6 col-md-offset-3">
               @if(count($errors)>0)
                   <div class="alert alert-danger">
                       <ul>
                       @foreach($errors->all() as $error)
                           <li>{{$error}}</li>
                        @endforeach
                       </ul>
                   </div>
               @endif
               <form action="/admin/login" method="post">
                   {{csrf_field()}}
                   <div class="form-group">
                       <label for="exampleInputEmail1">账户</label>
                       <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="输入账户">
                   </div>
                   <div class="form-group">
                       <label for="exampleInputPassword1">密码</label>
                       <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="输入密码">
                   </div>
                   <button type="submit" class="btn btn-default">登录</button>
               </form>
           </div>
       </div>
    </div>

</body>
</html>