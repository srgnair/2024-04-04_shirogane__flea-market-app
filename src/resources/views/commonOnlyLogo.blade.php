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
        </header>

        <main>
            @yield('content')
        </main>

    </div>
</body>

</html>