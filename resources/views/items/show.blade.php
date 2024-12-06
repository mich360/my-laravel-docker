<!DOCTYPE html>
<!-- /Users/user1/Desktop/my-laravel-docker/resources/views/items/show.blade.php-->
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $item->name }} - 商品詳細</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
           
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
        .item-image{
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid coral;
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
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="{{ route('items.index') }}">商品一覧</a></li>
            <li><a href="{{ route('cart.index') }}">カート</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="item-detail">
        <h1>{{ $item->name }}</h1>
        <div class="item-image">
            <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}の画像">
        </div>
        <div class="item-info">
            <p>価格: <strong>{{ $item->price }}円</strong></p>
            <p>{{ $item->description }}</p>
        </div>
        
        <!-- カートに追加するフォーム -->
        <div class="add-to-cart">
            <form action="{{ route('cart.add', $item->id) }}" method="POST">
                @csrf
                <button type="submit">カートに追加</button>
            </form>
        </div>
    </div>
</main>

<footer>
    <p>&copy; {{ date('Y') }} 商品詳細ページ</p>
</footer>

</body>
</html>
