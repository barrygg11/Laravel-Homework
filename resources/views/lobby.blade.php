<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>大廳畫面</title>
    </head>
    <body>
        @csrf
        <h2>大廳</h2>
        <h3>{{Session::get('name')}}，您好</h3>
        <p>
        <h3>帳戶金額：{{ $overage }}</h3>
        <p>
        1.<a href="{{ route('edit') }}">修改密碼</a><br>
        2.<a href="{{ route('account.get') }}">帳戶資料</a><br>
        3.<a href="{{ route('logout.get') }}">登出</a>
        <table style="border:3px #cccccc solid;" cellpadding="10" border='1' align="left">
            <tr>
                <th>遊戲</th>
                <th>期數</th>
                <th>操作</th>
            </tr>
            @foreach ($getOpenGame as $openGame)
            <tr>
                <td>{{ $openGame['name'] }}</td>
                <td>{{ $openGame['game_num'] }}</td>
                <td><a href="/user/game/{{$openGame['game_type']}}">〖GO〗</a></td>
            </tr>
            @endforeach
        </table>
    </body>
</html>