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

            <div class="header__search-function">
                <input class="header__search-function--input" type="text" name="keyword" placeholder=" なにをお探しですか？">
                <input type="submit" value="検索">
            </div>

            @if(Auth::check())
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
                    <a href="{{ route('registerView') }}">
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