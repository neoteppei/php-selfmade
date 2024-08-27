<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <title>ダイビングスポット情報</title>
</head>
<body>
    <h1>ダイビングスポット情報</h1>

    @if($divingSpot)
        <div>
            <h2>{{ $divingSpot->name }}</h2>
            <p><strong>位置:</strong> {{ $divingSpot->location }}</p>
            <p><strong>緯度:</strong> {{ $divingSpot->latitude }}</p>
            <p><strong>経度:</strong> {{ $divingSpot->longitude }}</p>
            <p><strong>説明:</strong> {{ $divingSpot->description }}</p>
            <p><strong>最大深度:</strong> {{ $divingSpot->depth }}</p>
            <p><strong>視界:</strong> {{ $divingSpot->visibility }}</p>
            <p><strong>水温:</strong> {{ $divingSpot->water_temperature }} °C</p>
            <p><strong>天気:</strong> {{ $divingSpot->weather }}</p>
            <p><strong>風速:</strong> {{ $divingSpot->wind_speed }} m/s</p>
            <p><strong>風向:</strong> {{ $divingSpot->wind_direction }} °</p>
        </div>
        
    @else
        <p>ダイビングスポット情報が見つかりませんでした。</p>
    @endif
</body>
</html>