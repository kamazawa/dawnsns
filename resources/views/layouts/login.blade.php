<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title>DAWN-SNS</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
          <h1><a href="/top"><img src="./images/main_logo.png" alt="ロゴマーク"></a></h1>
            <div class="menu">
                <input type="checkbox" id="menu_bar">
                <label for="menu_bar">{{ Auth::user() -> username }}さん</label>
                <ul id="links">
                    <li><a href="/top">ホーム</a></li>
                    <li><a href="/profile">プロフィール</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                </ul>
                <img src="./images/dawn.png" alt="アイコン">
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user() -> username }}さんの</p>
                <div class='following'>
                 <p>フォロー数</p>
                     <p>{{ $follow }} 名</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div class='followed'>
                    <p>フォロワー数</p>
                    <p>{{ $follower }} 名</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <div id="search">
                <a href="/search">ユーザー検索</a></div>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com//jquery-3.6.0.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
