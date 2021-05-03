<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>結算畫面</title>
    </head>
    <body>
        <h2>結算畫面</h2>
    <table>
        <form action="/admin/close" method="post">
            @csrf
        遊戲：{{ $getOpenGame[0]['name'] }}
        <p>
        期數：{{ $getOpenGame[0]['game_num'] }}
        <p>
        <input type="submit" name="submit" value="送出">
        <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/admin/gameControl'" value="回遊戲管理">
        @include('flash-message')
    </body>
</html>