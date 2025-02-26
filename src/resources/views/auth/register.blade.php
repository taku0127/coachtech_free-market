@extends('layouts.default')
@section('title', '会員登録')
@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
<div class="l-container">
    <div class="p-auth">
        <h1 class="p-auth_title">
            会員登録
        </h1>
        <form action="/register" method="POST">
            @csrf
            <div class="c-form p-auth_content">
                <div class="c-form_group">
                    <label for="name" class="c-form_label">ユーザー名</label>
                    <input type="text" id="name" name="name" class="c-form_input" value="{{ old('name') }}">
                    @error('name')
                    <p class="c-form_error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="c-form_group">
                    <label for="email" class="c-form_label">メールアドレス</label>
                    <input type="email" id="email" name="email" class="c-form_input" value="{{ old('email') }}">
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
                    @if ($message != 'パスワードと一致しません')
                    <p class="c-form_error">
                        {{ $message }}
                    </p>
                    @endif
                    @enderror
                </div>
                <div class="c-form_group">
                    <label for="password_confirmation" class="c-form_label">確認用パスワード </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="c-form_input">
                    @error('password')
                    @if ($message == 'パスワードと一致しません')
                    <p class="c-form_error">
                        {{ $message }}
                    </p>
                    @endif
                    @enderror
                </div>
                <div class="c-form_buttons">
                    <button type="submit" class="c-button">登録する</button>
                    <a href="/login" class="c-link c-form_buttons_link">ログインはこちら</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
