<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>登入畫面</title>
    </head>
    <body>
        <form action="login" method="post">
            @csrf
            <h2>登入</h2>
            使用者：<input type="text" name="name" required>
            <p>
            密碼：<input type="password" name="password" required>
            <p>
            <input type="submit" name="submit" value="登入">
            @include('flash-message')
        </form>
    </body>
</html>