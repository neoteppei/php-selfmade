<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Log Details</title>
</head>
<body>
<button onclick="window.location.href='{{ route('logs.index') }}';">トップへ戻る</button>
    <h1>ログ詳細</h1>

    <table>
        <tr>
            <th>ダイブ日</th>
            <td>{{ $log->dive_date }}</td>
        </tr>
        <tr>
            <th>経験本数</th>
            <td>{{ $log->experience_number }}</td>
        </tr>
        <tr>
            <th>ダイブ場所</th>
            <td>{{ $log->dive_location }}</td>
        </tr>
        <tr>
            <th>ダイブポイント</th>
            <td>{{ $log->dive_point }}</td>
        </tr>
        <tr>
            <th>ダイブタイプ</th>
            <td>{{ $log->dive_type }}</td>
        </tr>
        <tr>
            <th>天気</th>
            <td>{{ $log->weather }}</td>
        </tr>
        <tr>
            <th>気温</th>
            <td>{{ $log->temperature }}</td>
        </tr>
        <tr>
            <th>風向</th>
            <td>{{ $log->wind_direction }}</td>
        </tr>
        <tr>
            <th>波の高さ</th>
            <td>{{ $log->wave_height }}</td>
        </tr>
        <tr>
            <th>うねり</th>
            <td>{{ $log->swell ? 'あり' : 'なし' }}</td>
        </tr>
        <tr>
            <th>干潮時間</th>
            <td>{{ $log->low_tide_time }}</td>
        </tr>
        <tr>
            <th>満潮時間</th>
            <td>{{ $log->high_tide_time }}</td>
        </tr>
        <tr>
            <th>シリンダー情報</th>
            <td>{{ $log->cylinder_type }}</td>
        </tr>
        <tr>
            <th>装備情報</th>
            <td>{{ $log->equipment_type }}</td>
        </tr>
        <tr>
            <th>エントリー</th>
            <td>{{ $log->entry_time }}</td>
        </tr>
        <tr>
            <th>エキジット</th>
            <td>{{ $log->exit_time }}</td>
        </tr>
        <tr>
            <th>ダイブ時間</th>
            <td>{{ $log->dive_duration }}</td>
        </tr>
        <tr>
            <th>最大深度</th>
            <td>{{ $log->max_depth }}</td>
        </tr>
        <tr>
            <th>平均深度</th>
            <td>{{ $log->avg_depth }}</td>
        </tr>
        <tr>
            <th>水温</th>
            <td>{{ $log->water_temp }}</td>
        </tr>
        <tr>
            <th>透明度</th>
            <td>{{ $log->visibility }}</td>
        </tr>
        <tr>
            <th>開始残圧</th>
            <td>{{ $log->start_pressure }}</td>
        </tr>
        <tr>
            <th>終了残圧</th>
            <td>{{ $log->end_pressure }}</td>
        </tr>
        <tr>
            <th>メモ</th>
            <td>{{ $log->memo }}</td>
        </tr>
        <tr>
            <th>写真</th>
            <td>
                @if ($log->photo_path)
                    <img src="{{ asset('storage/' . $log->photo_path) }}" alt="ダイブの写真">
                @else
                    写真はありません
                @endif
            </td>
        </tr>
        <tr>
            <th>バディの署名</th>
            <td>
                @if ($log->buddy_signature)
                    <img src="{{ asset('storage/' . $log->buddy_signature) }}" alt="バディの署名">
                @else
                    署名はありません
                @endif
            </td>
        </tr>
        <tr>
            <th>インストラクターの署名</th>
            <td>
                @if ($log->instructor_signature)
                    <img src="{{ asset('storage/' . $log->instructor_signature) }}" alt="インストラクターの署名">
                @else
                    署名はありません
                @endif
            </td>
        </tr>
    </table>
</body>
</html>