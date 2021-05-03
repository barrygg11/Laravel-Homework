<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>更改狀態</title>
    </head>
    <body>
        <h2>修改狀態</h2>
    <table>
        <form action="/admin/editStatus" method="post">
            @csrf
        <input type="hidden" name="game_id" value="{{ $editSingleStatus[0]['game_id'] }}">
        開啟<input type="radio" name="status" value="1" required>
        關閉<input type="radio" name="status" value="0">
        <p>
        <input type="submit" name="submit" value="送出">
        <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/admin/gameControl'" value="回遊戲管理">
        @include('flash-message')
    </body>
</html>