@extends('layouts.default')
@section('title', 'メール認証画面')
@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
    <div class="p-auth --emailVarify">
        <h1 class="p-auth_title">
            登録していただいたメールアドレスに認証メールを送付しました。<br>
            メール認証を完了してください。
        </h1>
        <div class="p-auth_linkBlock"><a class="p-auth_link" href="/email/verify">認証はこちらから</a></div>
        <form action="/email/verification-notification" method="POST">
            @csrf
            <div class="p-auth_button">
                <button class="c-link">認証メールを再送する</button>
            </div>
        </form>
    </div>
@endsection
