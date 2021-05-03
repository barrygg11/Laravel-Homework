<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>新增遊戲</title>
    </head>
    <body>
    <table>
        <h2>新增遊戲</h2>
        <form action="/admin/gameAdd" method="post">
            @csrf
        <select name="type">
            <option value="" selected>請選擇遊戲</option>
            <option value="TWBG">{{ $getGameType[0]['name'] }}</option>
            <option value="TWPL">{{ $getGameType[1]['name'] }}</option>
        </select>
        &nbsp;
        <p>
        <input type="submit" name="submit" value="送出">
        &nbsp;
        <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/admin/gameControl'" value="回遊戲管理">
        @include('flash-message')
    </form>
    </table>
    </body>
</html>