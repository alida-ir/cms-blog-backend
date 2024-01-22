<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('/files/css/login.css') }}">
    <title>AliDa - Login Page</title>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="post" action="{{ route('login-admin') }}">
                @csrf
                <input name="username" type="text" required placeholder="UserName"/>
                <input name="password" type="password" required placeholder="Password"/>
                <button>login</button>
            </form>
        </div>
    </div>
</body>

</html>

