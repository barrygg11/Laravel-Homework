<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>修改密碼</title>
    </head>
    <body>
        <form action="edit" method="post">
        @csrf
        <h2>{{Session::get('name')}}, 修改密碼</h2>
        密碼：<input type="password" name="password" required>
        <p>
        <input type="submit" name="submit" value="修改">
        <input type ="button" onclick="history.back()" value="回到上一頁">
        @include('flash-message')
        </form>
    </body>
</html>