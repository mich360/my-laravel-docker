<!DOCTYPE html>
<!-- /Users/user1/Desktop/my-laravel-docker/resources/views/items/index.blade.php -->
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>商品一覧</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 0;
           
        }
        header nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-between;
            background-color: #333;
            color: blue;
            padding: 10px 20px;
        }
        header nav ul li {
            display: inline;
            margin-right: 15px;
        }
        header nav ul li a {
            color: blue;
            text-decoration: none;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        li {
            background: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        h2 {
            font-size: 1.2em;
            margin: 10px 0;
        }
        p {
            margin: 5px 0;
        }
        button {
            background-color: #0e6ab5;      /*赤い系*/
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #d32f2f; /* 赤い系*/
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            @auth
                <li>ようこそ、{{ Auth::user()->name }}さん</li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">ログイン</a></li>
                <li><a href="{{ route('register') }}">新規登録</a></li>
            @endauth
            <li><a href="{{ route('items.index') }}">商品一覧</a></li>
      
            <li class="search-form">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="query" placeholder="検索">
                    <button type="submit">検索</button>
                </form>
            </li>
        </ul>
    </nav>
</header>

<style>
    .search-form {
        margin-left: auto; /* 右寄せ */
    }
</style>
<main>
    <h1>商品一覧</h1>
    <ul>
    @foreach($items as $item)
    <li>
        <h2><a href="{{ route('items.show', $item->id) }}">{{ $item->name }}</a></h2>
        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}の画像">
        <p>価格: {{ $item->price }}円</p>
        <p>{{ $item->description }}</p>

        <!-- カートに追加ボタン -->
        <form action="{{ route('cart.add', $item->id) }}" method="POST">
            @csrf
            <button type="submit">カートに追加</button>
        </form>
    </li>
    @endforeach

    </ul>
    <!-- アイテムのループ表示 -->
   
</main>
</body>
</html>
