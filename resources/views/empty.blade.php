<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Empty Page</title>
</head>
<body>
<button id="new-create-button" onclick="window.location.href='{{ route('logs.create') }}';">新規作成</button>

 <table>
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
</body>
</html>