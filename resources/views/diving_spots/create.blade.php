<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <title>ダイビングスポット情報検索</title>
</head>

<body>
<button onclick="window.location.href='{{ route('logs.index') }}';">トップへ戻る</button>
    <h1>ダイビングスポット情報検索</h1>

    <!-- 検索フォーム -->
    <form action="{{ route('diving_spots.search') }}" method="POST">
        @csrf
        <div>
            <label for="location">場所:</label>
            <input type="text" id="location" name="location" required value="{{ old('location', $location ?? '') }}">
        </div>
        <button type="submit">検索</button>
    </form>

    <!-- 検索結果の表示 -->
    @if(isset($divingSpot))
        <h2>検索結果</h2>
        <p><strong>場所:</strong> {{ $divingSpot->location }}</p>
        <p><strong>緯度:</strong> {{ $divingSpot->latitude }}</p>
        <p><strong>経度:</strong> {{ $divingSpot->longitude }}</p>
        <p><strong>温度:</strong> {{ $divingSpot->temperature }}°C</p>
        <p><strong>湿度:</strong> {{ $divingSpot->humidity }}%</p>
        <p><strong>気圧:</strong> {{ $divingSpot->pressure }} hPa</p>
        <p><strong>天気:</strong> {{ $divingSpot->weather_description }}</p>
        <p><strong>風速:</strong> {{ $divingSpot->wind_speed }} m/s</p>
        <p><strong>風向:</strong> {{ $divingSpot->wind_direction }}°</p>
        <p><strong>海面気圧:</strong> {{ $divingSpot->sea_level_pressure }} hPa</p>
        <p><strong>地上気圧:</strong> {{ $divingSpot->ground_level_pressure }} hPa</p>
        <p><strong>最低気温:</strong> {{ $divingSpot->temp_min }}°C</p>
        <p><strong>最高気温:</strong> {{ $divingSpot->temp_max }}°C</p>
    @endif
</body>

</html>