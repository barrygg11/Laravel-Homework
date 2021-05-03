<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>遊戲</title>
    </head>
    <body>
        @if($game_type == "TWBG")
        <table>
            <h2>{{ $getOpenGame[0]['name'] }}</h2>
            <form action="/user/game/TWBG" method="post">
            @csrf
            玩家：{{Session::get('name')}}
            <p>
            目前餘額：{{ $overage }}
            <p>
            大：<input type="text" name="big" value="0">
            小：<input type="text" name="small" value="0">
            單：<input type="text" name="single" value="0">
            雙：<input type="text" name="double" value="0">
            <p>
            <input type="submit" name="submit" value="送出">
            <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/lobby/user'" value="回大廳">
            @include('flash-message')
        </table>
        @else
        <table>
            <h2>{{ $getOpenGame[1]['name'] }}</h2>
            <form action="/user/game/TWPL" method="post">
            @csrf
            玩家：{{Session::get('name')}}
            <p>
            目前餘額：{{ $overage }}
            <p>
            威力彩<input type="radio" name="status" value="3" required>
            <p>
            <input type="submit" name="submit" value="送出">
            <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/lobby/user'" value="回大廳">
            @include('flash-message')
        </table>
        @endif
    </body>
</html>