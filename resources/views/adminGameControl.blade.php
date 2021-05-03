<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>遊戲管理</title>
    </head>
    <body>
    <table>
        <h2>遊戲管理</h2>
            @csrf
            <a href="{{ route('admin.gameAdd') }}">新增遊戲</a><br>
            <p>
            <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/lobby/root'" value="回管理員介面">
    </table>
    <table style="border:3px #cccccc solid;" cellpadding="10" border='1' align="left">
        <tr>
            <th>遊戲</th>
            <th>期數</th>
            <th>狀態</th>
            <th>注單</th>
            <th>操作</th>
        </tr>
        @foreach($gameAll as $data)
        <tr>
            <td>{{ $data[0]['game_name'] }}</td>
            <td>{{ $data[0]['game_num'] }}</td>
            <td>{{ $data[0]['status_name'] }}</td>
            <td><a href="/admin/orders/{{ $data[0]['game_id'] }}">〖所有注單〗</a></td>
            <td colspan="2">
                @if($data[0]['status_name'] == "開啟" || $data[0]['status_name'] == "關閉")
                <a href="/admin/editStatus/{{ $data[0]['game_id'] }}">〖開關〗</a>
                <a href="/admin/close/{{ $data[0]['game_id'] }}">〖結算〗</a>
                <a href="/admin/cancel/{{ $data[0]['game_id'] }}">〖取消〗</a>
                @elseif($data[0]['status_name'] == "已結算")
                〖已結算〗
                @elseif($data[0]['status_name'] == "取消")
                〖已取消〗
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    </body>
</html>