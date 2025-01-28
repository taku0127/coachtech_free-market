@extends('layouts.default')
@section('title', 'ログイン')
@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
<div class="l-container">
    <div class="p-auth">
        <h1 class="p-auth_title">
            ログイン
        </h1>
        <form action="">
            @csrf
            <div class="c-form p-auth_content">
                <div class="c-form_group">
                    <label for="name" class="c-form_label">ユーザー名 / メールアドレス</label>
                    <input type="text" id="name" name="name" class="c-form_input">
                </div>
                <div class="c-form_group">
                    <label for="password" class="c-form_label">パスワード</label>
                    <input type="password" id="password" name="password" class="c-form_input">
                </div>
                <div class="c-form_buttons">
                    <button type="submit" class="c-button">ログインする</button>
                    <a href="" class="c-link c-form_buttons_link">会員登録はこちら</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
