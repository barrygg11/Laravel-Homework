<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>當期注單</title>
    </head>
    <body>
        <h2>當期注單</h2>
        <form action="/admin/orders" method="post">
        @csrf
        <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/admin/gameControl'" value="回到上一頁">
        @include('flash-message')
        </form>
    </body>
</html>