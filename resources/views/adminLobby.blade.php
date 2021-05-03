<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>管理員畫面</title>
    </head>
    <body>
        @csrf
        <h2>管理員大廳</h2>
        <h3>{{Session::get('name')}}，您好</h3>
        <p>
        1.<a href="{{ route('edit') }}">修改管理員密碼</a><br>
        2.<a href="{{ route('admin.AccountManagement') }}">帳號管理</a><br>
        3.<a href="{{ route('admin.getAllUserData') }}">查看所有帳戶交易紀錄</a><br>
        4.<a href="{{ route('admin.gameControl') }}">遊戲管理</a><br>
        5.<a href="{{ route('logout.get') }}">登出</a>
    </body>
</html>