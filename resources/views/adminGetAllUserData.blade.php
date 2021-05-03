<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="uft-8">
        <title>帳號交易紀錄</title>
    </head>
    <body>
    <table>
        <form action="/admin/getAllUserData" method="post">
        @csrf
        <h2>所有帳號交易紀錄</h2>
        使用者：<input type="text" name="user">
        狀態：<select name="status">
            <option value="" selected>請選擇狀態</option>
            <option value="input">存款</option>
            <option value="output">提款</option>
        </select>
        時間：<input type="date" name="time">
        筆數：<input type="text" name="take">
        <p>
        <input type="submit" name="submit" value="查詢">
    </form>
    </table>
        <table style="border:3px #cccccc solid;" cellpadding="10" border='1'>
            <tr>
                <th>使用者</th>
                <th>金額</th>
                <th>狀態</th>
                <th>時間</th>
            </tr>
            @foreach($allUserData as $UserData)
            <tr>
                <td>{{ $UserData->user }}</td>
                <td>{{ $UserData->gold }}</td>
                <td>{{ $UserData->status }}</td>
                <td>{{ $UserData->time }}</td>
            </tr>
            @endforeach
        </table>
        <br>
        <input type ="button" onclick="javascript:location.href='http://127.0.0.1:8000/lobby/root'" value="回管理員介面">
    </body>
</html>