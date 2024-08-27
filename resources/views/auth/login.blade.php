<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>ログイン</title>
</head>

<body>
    <div class="login">
        <h1>ダイビングアプリ</h1>
        <h2>ログイン</h2>
   
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div>
                <label for="email">メールアドレス:</label>
                <input type="email" id="email" name="email" required style="width: 200px; height: 50px;">
            </div>
            <div>
                <label for="password">パスワード:</label>
                <input type="password" id="password" name="password" required style="width: 200px; height:50px;">
            </div>
            <button type="submit">ログイン</button>
        </form>
    
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <a href="{{ route('register') }}">新規登録</a>
    </div>
</body>

</html>
</body>

</html>