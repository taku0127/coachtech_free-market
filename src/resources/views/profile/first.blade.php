@extends('layouts.default')
@section('title', 'プロフィール設定')
@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')
<div class="l-container">
    <div class="p-profile">
        <h1 class="p-profile_title">
            プロフィール設定
        </h1>
        <form action="">
            @csrf
            <div class="c-form p-profile_content">
                <div class="c-form_group --image">
                    <div class="c-form_inputed-img">
                        <img class="js-preview" src="{{ asset('img/dummy.png')}}" alt="">
                    </div>
                    <label class="c-form_input-img">画像を選択する<input type="file" name="image" accept="image/*" class="js-input_img"></label>
                </div>
                <div class="c-form_group">
                    <label for="name" class="c-form_label">ユーザー名</label>
                    <input type="text" id="name" name="name" class="c-form_input">
                </div>
                <div class="c-form_group">
                    <label for="postcode" class="c-form_label">郵便番号</label>
                    <input type="text" id="postcode" name="postcode" class="c-form_input">
                </div>
                <div class="c-form_group">
                    <label for="address" class="c-form_label">住所</label>
                    <input type="text" id="address" name="address" class="c-form_input">
                </div>
                <div class="c-form_group">
                    <label for="building" class="c-form_label">建物名</label>
                    <input type="text" id="building" name="building" class="c-form_input">
                </div>
                <div class="c-form_buttons --profile">
                    <button type="submit" class="c-button">更新する</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
