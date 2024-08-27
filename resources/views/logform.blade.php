<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログフォーマット</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/logformat.css') }}">
</head>

<body> 
    <button onclick="window.location.href='{{ route('logs.index') }}';">トップへ戻る</button>
    <form action="{{ route('logs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="top">
            <p>潜水日</p> <input type="date" id="dive" name="dive_date">
            <p>経験本数</p> <input type="text" id="exp" name="experience_number">本
        </div>

        <div class="top2">
            <p>潜水地</p> <input type="text" id="sensui" name="dive_location">
            <p>ポイント名</p> <input type="text" id="point" name="dive_point">

            <select name="dive_type">
                <option value="">---ダイビング種類---</option>
                <option value="beach">ビーチ</option>
                <option value="boat">ボート</option>
                <option value="half">ハーフボート</option>
                <option value="fan">ファン</option>
                <option value="kou">講習</option>
                <option value="hoka">その他</option>
            </select>
            <button id="get-location">現在地登録</button>
        </div>

        <div class="sea">
            <h2>天候/海況情報</h2>
            <div class="weather">
                <select name="weather">
                    <option value="">---天気---</option>
                    <option value="sunny">晴れ</option>
                    <option value="sunclo">晴れのち曇り</option>
                    <option value="cloudy">曇り</option>
                    <option value="reaclo">曇りのち雨</option>
                    <option value="rain">雨</option>
                    <option value="other">その他</option>
                </select>
                <label for="kion">気温</label> <input type="number" style="width: 30px;" name="temperature">度
            </div>
            <label for="kaze">風向</label> <input type="text" style="width: 30px;" name="wind_direction">➨<input type="text" style="width: 30px;" name="wind_direction"><br>
            <label for="kaze">波高</label> <input type="text" style="width: 30px;" name="wave_height">➨<input type="text" style="width: 30px;" name="wave_height">
            <label>ウネリ</label>
            <input type="text"  name="swell"><br>
            <label>潮汐</label> <label>干潮</label> <input type="time" id="appt" name="low_tide_time"> <label>満潮</label> <input type="time" id="appt" name="high_tide_time">
        </div>

<div class="kizai">
    <h2>シリンダー/器材情報</h2>
    <li>シリンダー情報</li>
    <label>容量</label> <input type="text" style="width: 40px;" name="cylinder_capacity">L
    <input type="checkbox" id="cylinder_type_steel" name="cylinder_type[]" value="スチール">
    <label for="cylinder_type_steel">スチール</label>
    <input type="checkbox" id="cylinder_type_aluminum" name="cylinder_type[]" value="アルミニウム">
    <label for="cylinder_type_aluminum">アルミニウム</label>
    <input type="checkbox" id="cylinder_type_nitrox" name="cylinder_type[]" value="Nitrox">
    <label for="cylinder_type_nitrox">Nitrox</label> <input type="text" style="width: 40px;" name="nitrox_percentage">%<br>

    <li>器材情報</li>
    <label>生地厚</label> <input type="text" style="width: 40px;" name="fabric_thickness">mm
    <input type="checkbox" id="equipment_type_fullsuit" name="equipment_type[]" value="フルスーツ">
    <label for="equipment_type_fullsuit">フルスーツ</label>
    <input type="checkbox" id="equipment_type_seagull" name="equipment_type[]" value="シーガル">
    <label for="equipment_type_seagull">シーガル</label>
    <input type="checkbox" id="equipment_type_longjohn" name="equipment_type[]" value="ロングジョン/パンツ">
    <label for="equipment_type_longjohn">ロングジョン/パンツ</label>
    <input type="checkbox" id="equipment_type_bolero" name="equipment_type[]" value="ボレロ/ジャケット">
    <label for="equipment_type_bolero">ボレロ/ジャケット</label>
    <input type="checkbox" id="equipment_type_drysuit" name="equipment_type[]" value="ドライスーツ">
    <label for="equipment_type_drysuit">ドライスーツ</label>
    <input type="checkbox" id="equipment_type_hood" name="equipment_type[]" value="フード">
    <label for="equipment_type_hood">フード</label><br>
    <input type="checkbox" id="equipment_type_gloves" name="equipment_type[]" value="グローブ">
    <label for="equipment_type_gloves">グローブ</label>
    <input type="checkbox" id="equipment_type_other" name="equipment_type[]" value="その他">
    <label for="equipment_type_other">その他</label> <input type="text" style="width: 100px;" name="other_equipment"><br>

    <input type="checkbox" id="accessory_weight" name="accessory[]" value="ウエイト">
    <label for="accessory_weight">ウエイト</label> <input type="text" style="width: 50px;" name="weight_kg">kg
    <input type="checkbox" id="accessory_ankle" name="accessory[]" value="アンクル">
    <label for="accessory_ankle">アンクルウエイト</label><br>

    <li>アクセサリー</li>
    <input type="checkbox" id="accessory_photography" name="accessory[]" value="撮影機材">
    <label for="accessory_photography">撮影機材</label> <input type="text" style="width: 200px;" name="photography_equipment"><br>
    <input type="checkbox" id="accessory_light" name="accessory[]" value="水中ライト">
    <label for="accessory_light">水中ライト</label>
    <input type="checkbox" id="accessory_float" name="accessory[]" value="フロート">
    <label for="accessory_float">フロート</label>
    <input type="checkbox" id="accessory_other" name="accessory[]" value="その他">
    <label for="accessory_other">その他</label> <input type="text" style="width: 150px;" name="other_accessories">
</div>

        <div class="dive">
            <h2>ダイビング情報</h2>
            <label>エントリー</label> <input type="time" name="entry_time"> <label>エキジット</label> <input type="time" name="exit_time">
            <label>潜水時間</label> <input type="text" style="width: 50px;" name="dive_duration">分<br>
            <label>最大水深</label> <input type="text" style="width: 50px;" name="max_depth">m <label>平均水深</label> <input type="text" style="width: 50px;" name="avg_depth">m<br>
            <label>水温</label> <input type="text" style="width: 50px;" name="water_temp">度 <label>透明度</label> <input type="text" style="width: 50px;" name="visibility">m<br>
            <label>開始残圧</label> <input type="text" style="width: 50px;" name="start_pressure">bar <label>終了残圧</label> <input type="text" style="width: 50px;" name="end_pressure">bar
        </div>

        <div class="sign">
            <p>バディサイン</p>
            <canvas id="canvas1" width="800" height="100"></canvas>
            <input type="hidden" name="buddy_signature" id="buddy_signature">
            <br>
            <button id="clear1" type="button">クリア</button><br>
        </div>

        <div class="memo-photo">
            <label for="memo">メモを書いてください:</label><br>
            <textarea id="memo" name="memo" rows="5" cols="40" placeholder="ここにメモを書いてください..."></textarea><br><br>

            <label for="photo">写真を選択してください:</label><br>
            <input type="file" id="photo" name="photo_path" accept="image/*"><br><br>
            <button type="button" id="delete-photo" style="display:none;">写真を削除</button><br><br>
        </div>

        <h2>アップロードされた写真</h2>
        <img id="preview" src="#" alt="写真のプレビュー" style="display:none; max-width: 80%; height: auto;">

        <div class="sign">
            <p>インストラクターサイン</p>
            <canvas id="canvas2" width="800" height="100"></canvas>
            <input type="hidden" name="instructor_signature" id="instructor_signature">
            <br>
            <button id="clear2" type="button">クリア</button><br>
        </div>

        <div class="save">
            <button type="submit">保存</button>
        </div>
    </form>
    <script src="js/logformat.js"></script>
</body>

</html>