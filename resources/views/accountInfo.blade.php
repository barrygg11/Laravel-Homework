<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>帳戶資料</title>
    </head>
    <body>
        <form action="account" method="post">
        @csrf
        <h2>{{Session::get('name')}},帳戶資料</h2>
        帳戶金額：{{ $overage }}
        <p>
        {{-- 帳號：<input type="text" name="user" required value="{{Session::get('name')}}">
        <p> --}}
        密碼：<input type="text" name="password" required>
        <p>
        金額：<input type="text" name="gold" required>
        <p>
        <input type="Radio" value="input" name="status" checked>存款
        <input type="Radio" value="output" name="status">提款
        <p>
        <input type="submit" name="submit" value="送出">
        <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/lobby/user'" value="回大廳">
        <br>
        @include('flash-message')
        *************************<br>
        </form>
        <table>
            <h2>存提款資料</h2>
            <table style="border:3px #cccccc solid;" cellpadding="10" border='1'>
                <tr>
                    <th>使用者</th>
                    <th>金額</th>
                    <th>狀態</th>
                    <th>時間</th>
                </tr>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->user }}</td>
                <td>{{ $post->gold }}</td>
                <td>{{ $post->status }}</td>
                <td>{{ $post->time }}</td>
            </tr>
            @endforeach
    </body>
</html>