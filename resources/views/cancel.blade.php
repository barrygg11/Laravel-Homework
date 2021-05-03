<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>取消畫面</title>
    </head>
    <body>
        <h2>取消畫面</h2>
    <table>
        <form action="/admin/cancel" method="post">
            @csrf
        <input type="hidden" name="game_id" value="{{ $editSingleStatus[0]['game_id'] }}">
        取消<input type="radio" name="status" value="3" required>
        <p>
        <input type="submit" name="submit" value="送出">
        <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/admin/gameControl'" value="回遊戲管理">
        @include('flash-message')
    </body>
</html>