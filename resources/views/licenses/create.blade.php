<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <title>ライセンス情報登録</title>
</head>
<body>
<button onclick="window.location.href='{{ route('logs.index') }}';">トップへ戻る</button>
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('licenses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="license_name">ライセンス名:</label>
            <input type="text" id="license_name" name="license_name" required>
        </div>
        <div>
            <label for="license_images">ライセンス画像:</label>
            <input type="file" id="license_images" name="license_images[]" multiple>
        </div>
        <button type="submit">登録</button>
    </form>

    @if(isset($license))
        <h2>登録された画像</h2>
        @foreach($license->images as $image)
            <div>
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="License Image" style="width: 150px; height: auto; cursor: pointer;" onclick="showModal('{{ asset('storage/' . $image->image_path) }}')">
              
            </div>
        @endforeach
    @endif

    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="img01">
    </div>
    <script>
        function showModal(imageSrc) {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("img01");
            modal.style.display = "block";
            modalImg.src = imageSrc;
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>
</body>
</html>