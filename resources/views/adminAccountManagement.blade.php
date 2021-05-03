<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>帳號管理</title>
    </head>
    <body>
        @csrf
        <h2>帳號管理</h2>
        <table style="border:3px #cccccc solid;" cellpadding="10" border='1'>
            <tr>
                <th>帳號</th>
                <th>密碼</th>
                <th>權限</th>
                <th>操作</th>
            </tr>
            @foreach($adminAccountManagement as $AccountManagement)
            <tr>
                <td>{{ $AccountManagement->name }}</td>
                <td>{{ $AccountManagement->password }}</td>
                <td>{{ $AccountManagement->level }}</td>
                <td><a href = '/admin/AccountManagement/{{ $AccountManagement->user_id }}'>刪除</a></td>
            </tr>
            @endforeach
        </table>
        <br>
        <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/lobby/root'" value="回管理員介面">
        @include('flash-message')
    </body>
</html>