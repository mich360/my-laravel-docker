<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>カート</title>
    <style>
    /* 全体のスタイル */
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        max-width: 850px;
        margin: 0 auto;
        background-color: #e6f1f2;
        color: #333;
    }

    /* ヘッダーとナビゲーション */
    header nav ul {
        height: 80px;
        list-style: none;
        padding: 10px 20px;
        margin: 0;
        display: flex;
        align-items: center;
        background-color: #333;
        color: #333;
        border-radius: 5px;
    }

    header nav ul li {
        margin-right: 11px;
         margin-left: 5px;
    }

    header nav ul li:last-child {
        margin-right: 5px;
       
    }

    header nav ul li a {
        color: blue;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    header nav ul li a:hover {
        background-color: #555;
    }

    /* ログアウトボタン */
    .nav-list {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .nav-list .logout {
        margin-left: auto;
    }

    .nav-list .logout button {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .nav-list .logout button:hover {
        background-color: #d32f2f;
    }

    /* 見出し */
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    /* グリッドのアイテムリスト */
    ul {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    li {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .item-image {
        max-width: 600px;
        margin: 0 auto;
        border: 1px solid coral;
    }

    img {
        width: 100%;
        height: auto;
        border-radius: 5px;
    }

    /* テキスト */
    h2 {
        font-size: 1.2em;
        margin: 10px 0;
    }

    p {
        margin: 5px 0;
    }

    /* ボタン */
    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* レスポンシブ調整 */
    @media (max-width: 600px) {
        header nav ul {
            flex-direction: column;
            align-items: flex-start;
        }

        header nav ul li {
            margin-bottom: 10px;
        }

        .nav-list .logout {
            margin-left: 0;
            margin-top: 10px;
        }

        ul {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    }
</style>
</head>
<body>
<header>
    <nav>
        <ul class="nav-list">
            @auth
                <li>{{ Auth::user()->name }}さん</li>
                <li class="logout">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
            @endauth
            <li><a href="{{ route('items.index') }}">商品一覧</a></li>
        </ul>
    </nav>
</header>

<h1>カートの中身</h1>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<ul>
    @php $total = 0; @endphp <!-- 合計金額の初期化 -->
    @foreach($cart as $itemId => $item)
        @php $total += $item['price'] * $item['quantity']; @endphp <!-- 合計金額を計算 -->
        <li>
            {{ $item['name'] }} - ¥{{ number_format($item['price']) }} x 
            <form action="{{ route('cart.update', $itemId) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 50px;">
                <button type="submit">更新</button>
            </form>
            <form action="{{ route('cart.remove', $itemId) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </li>
    @endforeach
</ul>

<p><strong>合計金額: ¥{{ number_format($total) }}</strong></p> <!-- 合計金額を表示 -->

<a href="{{ route('items.index') }}">商品一覧に戻る</a>
</body>
</html>

