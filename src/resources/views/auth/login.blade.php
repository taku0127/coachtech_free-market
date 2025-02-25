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
        <form action="/login" method="POST">
            @csrf
            <div class="c-form p-auth_content">
                <div class="c-form_group">
                    <label for="email" class="c-form_label">メールアドレス</label>
                    <input type="text" id="email" name="email" class="c-form_input" value="{{ old('email') }}">
                    @error('email')
                    <p class="c-form_error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="c-form_group">
                    <label for="password" class="c-form_label">パスワード</label>
                    <input type="password" id="password" name="password" class="c-form_input">
                    @error('password')
                    <p class="c-form_error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="c-form_buttons">
                    <button type="submit" class="c-button">ログインする</button>
                    <a href="/register" class="c-link c-form_buttons_link">会員登録はこちら</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
