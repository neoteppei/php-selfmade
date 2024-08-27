//手書き入力欄

document.addEventListener('DOMContentLoaded', function() {
    setupCanvas('canvas1', 'clear1');
    setupCanvas('canvas2', 'clear2');
});

function setupCanvas(canvasId, clearButtonId) {
    const canvas = document.getElementById(canvasId);
    const context = canvas.getContext('2d');
    let isDrawing = false;
    let lastPosition = { x: null, y: null };

    // 描画開始
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mousemove', draw);

    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchend', stopDrawing);
    canvas.addEventListener('touchmove', draw);

    function startDrawing(e) {
        isDrawing = true;
        context.beginPath();
        lastPosition.x = getX(e);
        lastPosition.y = getY(e);
        context.moveTo(lastPosition.x, lastPosition.y);
    }

    function stopDrawing() {
        isDrawing = false;
        context.closePath();
        lastPosition.x = null;
        lastPosition.y = null;
    }

    function draw(e) {
        if (!isDrawing) return;
        context.lineCap = "round";
        context.lineWidth = 3;
        context.strokeStyle = "black";
        let x = getX(e);
        let y = getY(e);
        context.lineTo(x, y);
        context.stroke();
        lastPosition.x = x;
        lastPosition.y = y;
    }

    function getX(e) {
        if (e.type.includes('touch')) {
            return e.touches[0].clientX - canvas.getBoundingClientRect().left;
        } else {
            return e.clientX - canvas.getBoundingClientRect().left;
        }
    }

    function getY(e) {
        if (e.type.includes('touch')) {
            return e.touches[0].clientY - canvas.getBoundingClientRect().top;
        } else {
            return e.clientY - canvas.getBoundingClientRect().top;
        }
    }

    function clearCanvas() {
        context.clearRect(0, 0, canvas.width, canvas.height);
    }

    document.getElementById(clearButtonId).addEventListener('click', clearCanvas);
}

function saveSignatures() {
    var canvas1 = document.getElementById('canvas1');
    var canvas2 = document.getElementById('canvas2');

    document.getElementById('buddy_signature').value = canvas1.toDataURL();
    document.getElementById('instructor_signature').value = canvas2.toDataURL();
}


//現在地登録
document.getElementById('get-location').addEventListener('click', function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
});

function success(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    
    const apiKey = 'AIzaSyC62k21uLKpGYgkGk3zJ9CoSFLXIacwnxQ';
    const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.results && data.results[0]) {
                const address = data.results[0].formatted_address;
                document.getElementById('sensui').value = address;
                document.getElementById('point').value = ""; 
            } else {
                console.error('No results found');
            }
        })
        .catch(err => console.error('Error:', err));
}

function error() {
    alert('現在地を取得できませんでした。');
}

//写真登録
document.getElementById('photo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const deleteButton = document.getElementById('delete-photo');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('preview');
            img.src = e.target.result;
            img.style.display = 'block';
            deleteButton.style.display = 'inline'; // 削除ボタンを表示
        }
        reader.readAsDataURL(file);
    }
});

// 写真を削除する機能
document.getElementById('delete-photo').addEventListener('click', function() {
    const img = document.getElementById('preview');
    const photoInput = document.getElementById('photo');
    img.src = '#';
    img.style.display = 'none';
    photoInput.value = ''; // ファイル入力をリセット
    this.style.display = 'none'; // 削除ボタンを非表示
});

// フォーム送信時の処理
document.getElementById('memoPhotoForm').addEventListener('submit', function(event) {
    event.preventDefault(); // ページリロードを防ぐ

    // メモの内容を取得
    const memo = document.getElementById('memo').value;

    // 写真の内容を取得（base64形式でサーバに送信可能）
    const photo = document.getElementById('photo').files[0];

    // フォームの内容をサーバに送信するなどの処理をここに追加
    console.log('メモ:', memo);
    if (photo) {
        console.log('写真:', photo.name);
    } else {
        console.log('写真が選択されていません。');
    }

    
});