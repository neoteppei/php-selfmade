<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <title>Edit Log</title>
</head>
<body>
<button onclick="window.location.href='{{ route('logs.index') }}';">トップへ戻る</button>
    <h1>ログ編集</h1>
    <form action="{{ route('logs.update', $log->id) }}" method="POST">
        @csrf
        @method('PUT')

        <form action="{{ route('logs.update', $log->id) }}" method="POST">
    @csrf
    @method('PUT')

        <label for="dive_date">潜水日:</label>
        <input type="date" id="dive_date" name="dive_date" value="{{ old('dive_date', session('dive_date', $log->dive_date)) }}" required><br>

        <label for="experience_number">潜水経験回数:</label>
        <input type="number" id="experience_number" name="experience_number" value="{{ old('experience_number', session('experience_number', $log->experience_number)) }}" required><br>

        <label for="dive_location">潜水地:</label>
        <input type="text" id="dive_location" name="dive_location" value="{{ old('dive_location', session('dive_location', $log->dive_location)) }}" required><br>

        <label for="dive_point">ポイント名:</label>
        <input type="text" id="dive_point" name="dive_point" value="{{ old('dive_point', session('dive_point', $log->dive_point)) }}" required><br>

        <label for="dive_type">ダイブタイプ:</label>
        <input type="text" id="dive_type" name="dive_type" value="{{ old('dive_type', session('dive_type', $log->dive_type)) }}" required><br>

        <label for="weather">天気:</label>
        <input type="text"  id="weather" name="weather" value="{{ old('weather', session('weather', $log->weather)) }}" required><br>

        
        <label for="temperature">気温:</label>
        <input type="text" id="temperature"  name="temperature" value="{{old('temperature', session('temperature', $log->temperature)) }}" required><br>

        <label for="wind_direction">風向:</label>
        <input type="text" id="wind_direction" name="wind_direction" value="{{ old('wind_direction', session('wind_direction', $log->wind_direction)) }}" required><br>

        <label for="wave_height">波の高さ:</label>
        <input type="text" id="wave_height" name="wave_height" value="{{ old('wave_height', session('wave_height', $log->wave_height)) }}" required><br>

        <label for="swell">うねり:</label>
        <select name="swell">
            <option value="あり" value="{{ old('swell', session('swell', $log->swell)) === 'あり' ? 'selected' : '' }}">あり</option>
            <option value="なし" value="{{ old('swell', session('swell', $log->swell)) === 'なし' ? 'selected' : '' }}">なし</option>
        </select><br>

        <label for="low_tide_time">干潮時間:</label>
        <input type="time" name="low_tide_time" value="{{ old('low_tide_time', session('low_tide_time', $log->low_tide_time)) }}"><br>

        <label for="high_tide_time">満潮時間:</label>
        <input type="time" name="high_tide_time" value="{{ old('high_tide_time', session('high_tide_time', $log->high_tide_time)) }}"><br>

        <label for="cylinder_type">シリンダー情報:</label>
        <input type="text" name="cylinder_type" value="{{ old('cylinder_type', session('cylinder_type', $log->cylinder_type)) }}"><br>

        <label for="equipment_type">器材情報:</label>
        <input type="text" name="equipment_type" value="{{ old('equipment_type', session('equipment_type', $log->equipment_type)) }}"><br>


        <label for="entry_time">潜水開始時間:</label>
        <input type="time" name="entry_time" value="{{ old('entry_time', session('entry_time', $log->entry_time)) }}"><br>

        <label for="exit_time">潜水終了時間:</label>
        <input type="time" name="exit_time" value="{{ old('exit_time', session('exit_time', $log->exit_time)) }}"><br>

        <label for="dive_duration">潜水時間:</label>
        <input type="text" name="dive_duration" value="{{ old('dive_duration', session('dive_duration', $log->dive_duration)) }}"><br>

        <label for="max_depth">最大深度:</label>
        <input type="text" name="max_depth" value="{{ old('max_depth', session('max_depth', $log->max_depth)) }}"><br>

        <label for="avg_depth">平均深度:</label>
        <input type="text" name="avg_depth" value="{{ old('avg_depth', session('avg_depth', $log->avg_depth)) }}"><br>

        <label for="water_temp">水温:</label>
        <input type="text" name="water_temp" value="{{ old('water_temp', session('water_temp', $log->water_temp)) }}"><br>

        <label for="visibility">視界:</label>
        <input type="text" name="visibility" value="{{ old('visibility', session('visibility', $log->visibility)) }}"><br>

        <label for="start_pressure">開始圧:</label>
        <input type="text" name="start_pressure" value="{{ old('start_pressure', session('start_pressure', $log->start_pressure)) }}"><br>

        <label for="end_pressure">終了圧:</label>
        <input type="text" name="end_pressure" value="{{ old('end_pressure', session('end_pressure', $log->end_pressure)) }}"><br>

        <label for="memo">メモ:</label>
        <textarea name="memo">{{ old('memo', session('memo', $log->memo)) }}</textarea><br>

        <label for="photo">写真:</label>
        <input type="file" name="photo_path"><br>
        @if ($log->photo_path)
            <img src="{{ asset('storage/' . $log->photo_path) }}" alt="Log Photo" width="100"><br>
        @endif

        <label for="buddy_signature">バディの署名:</label>
        <input type="text" name="buddy_signature" value="{{ old('buddy_signature', session('buddy_signature', $log->buddy_signature)) }}"><br>

<label for="instructor_signature">インストラクターの署名:</label>
<input type="text" name="instructor_signature" value="{{ old('instructor_signature', session('instructor_signature', $log->instructor_signature)) }}"><br>
        <button type="submit">更新</button>
    </form>
    <a href="{{ route('logs.index') }}">戻る</a>
</body>
</html>