<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <script src="{{ asset('js/main.js') }}"></script>
</head>
<body>
    <header class="c-header">
        <p class="c-header_logo">
            <img src="{{ asset('img/logo.svg') }}" alt="">
        </p>
        @if (!Request::is('login','register'))
        <div class="c-header_input"><input type="text" placeholder="なにをお探しですか"></div>
        <div class="c-header_links">
            @auth
            <form class="form" action="/logout" method="post">
                @csrf
                <button class="c-header_link">ログアウト</button>
            </form>
            @endauth
            @guest
                <a href="/login" class="c-header_link">ログイン</a>
            @endguest
            <a href="/mypage" class="c-header_link">マイページ</a>
            <a href="/sell" class="c-header_btn">出品</a>
        </div>
        @endif
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
