<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>

    <div class="wrapper">
        <header>
            <div class="header__logo">
                <div class="img">
                    <a href="{{ route('mainView') }}"><img src="{{ asset('img/coachtechLogo.png') }}"></a>
                </div>
            </div>
            <div class="header__search-function--wrapper">
                <form action="{{ route('mainView') }}" method="GET">
                    @csrf
                    <div class="header__search-function">
                        <select name="category">
                            <option value="">全て</option>
                            <option value="1">ファッション</option>
                            <option value="2">ベビー・キッズ</option>
                            <option value="3">ゲーム・おもちゃ・グッズ</option>
                            <option value="3">メンズ</option>
                            <option value="3">レディース</option>
                        </select>

                        <select name="condition">
                            <option value="">全て</option>
                            <option value="1">新品、未使用</option>
                            <option value="2">未使用に近い</option>
                            <option value="3">目立った傷や汚れなし</option>
                            <option value="4">やや傷や汚れあり</option>
                            <option value="5">傷や汚れあり</option>
                        </select>

                        <input class="header__search-function--input" type="text" name="keyword" placeholder=" なにをお探しですか？">

                        <button type="submit">検索</button>

                    </div>

                </form>
            </div>

            @if(Auth::check() && Auth::user()->role === 'admin')
            <ul class="header__ul">
                <form action="/logout" method="post">
                    @csrf
                    <li>
                        <button class="header__ul--button">
                            ログアウト
                        </button>
                    </li>
                </form>
                <li>
                    <a href="{{ route('adminView') }}">
                        <button class="header__ul--button">
                            管理者
                        </button>
                    </a>
                </li>
            </ul>

            @elseif(Auth::check())
            <ul class="header__ul">
                <form action="/logout" method="post">
                    @csrf
                    <li>
                        <button class="header__ul--button">
                            ログアウト
                        </button>
                    </li>
                </form>
                <li>
                    <a href="{{ route('mypageView') }}">
                        <button class="header__ul--button">
                            マイページ
                        </button>
                    </a>
                </li>
            </ul>

            @else
            <ul class="header__ul">
                <li>
                    <a href="{{ route('loginView') }}">
                        <button>
                            ログイン
                        </button>
                    </a>
                </li>
                <li>
                    <a href="{{ route('registerView') }}">
                        <button>
                            会員登録
                        </button>
                    </a>
                </li>
            </ul>
            @endif

            <div class="header__list-button">
                <a href="{{ route('displayItemView') }}">
                    <button>出品</button>
                </a>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

    </div>
</body>

</html>