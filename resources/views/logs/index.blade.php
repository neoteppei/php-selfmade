<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>ログ一覧</title>
</head>
<body>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">ログアウト</button>
</form>
<div class="button">
    <button id="new-create-button" onclick="window.location.href='{{ route('logs.create') }}';">新規作成</button>
    <button id="license-register-button" onclick="window.location.href='{{ route('licenses.create') }}';">ライセンス情報登録</button>
    <button id="diving-spot-search-button" onclick="window.location.href='{{ route('diving_spots.create') }}';">ダイビングスポット情報検索</button>
    @if(Auth::check() && Auth::user()->role === 'admin')
    <button id="admin-function-button" onclick="window.location.href='{{ route('admin.users') }}';">管理機能</button>
    @endif
</div>    
 <table>
    <h1>ログデータ一覧</h1>
        <thead>
            <tr>
                <th>潜水日</th>
                <th>潜水地</th>
                <th>ポイント名</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->dive_date }}</td>
                <td>{{ $log->dive_location }}</td>
                <td>{{ $log->dive_point }}</td>
                <td>
                    <a href="{{ route('logs.show', $log->id) }}">詳細</a>
                    <a href="{{ route('logs.edit', $log->id) }}">編集</a>
                    <form action="{{ route('logs.destroy', $log->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>