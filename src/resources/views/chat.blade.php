@extends('layouts.default')
@section('title', '取引チャット')
@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection
<div class="p-chat">
    <aside class="p-chat_side">
        <h2 class="p-chat_side_title">その他の取引</h2>
        <ul class="p-chat_side_lists">
            <li class="p-chat_side_list">
                <a href="" class="c-button --chatSide">商品名</a>
            </li>
            <li class="p-chat_side_list">
                <a href="" class="c-button --chatSide">商品名</a>
            </li>
        </ul>
    </aside>
    <section class="p-chat_main">
        <div class="p-chat_head">
            <div class="p-chat_title">
                <div class="p-chat_title_img"><img src="" alt=""></div>
                <p class="p-chat_title_text">「ユーザー名」さんとの取引画面</p>
            </div>
            <p class="p-chat_head_btn">取引を完了する</p>
        </div>
        <div class="p-chat_productInfo">
            <div class="p-chat_productInfo_img"><img src="" alt=""></div>
            <div class="p-chat_productInfo_texts">
                <h2 class="p-chat_productInfo_title">商品名</h2>
                <p class="p-chat_productInfo_text">商品価格</p>
            </div>
        </div>
        <div class="p-chat_chat">
            <div class="p-chat_chat_content">
                <div class="p-chat_chat_userInfo">
                    <div class="p-chat_chat_userInfo_img"><img src="" alt=""></div>
                    <p class="p-chat_chat_userInfo_name">ユーザー名</p>
                </div>
                <p class="p-chat_chat_message">相手のメッセージ</p>
            </div>
            <div class="p-chat_chat_content --ownMessage">
                <div class="p-chat_chat_userInfo">
                    <div class="p-chat_chat_userInfo_img"><img src="" alt=""></div>
                    <p class="p-chat_chat_userInfo_name">ユーザー名</p>
                </div>
                <p class="p-chat_chat_message">自分が送ったメッセージ</p>
                <div class="p-chat_chat_btns">
                    <p class="p-chat_chat_btn">編集</p>
                    <p class="p-chat_chat_btn">削除</p>
                </div>
            </div>
            <div class="p-chat_chat_content --ownMessage">
                <div class="p-chat_chat_userInfo">
                    <div class="p-chat_chat_userInfo_img"><img src="" alt=""></div>
                    <p class="p-chat_chat_userInfo_name">ユーザー名</p>
                </div>
                <p class="p-chat_chat_message">自分が送ったメッセージ</p>
                <div class="p-chat_chat_btns">
                    <p class="p-chat_chat_btn">編集</p>
                    <p class="p-chat_chat_btn">削除</p>
                </div>
            </div>
        </div>
        <div class="c-form p-chat_sendBox">
            <input type="text" name="" id="" placeholder="取引メッセージを記入してください">
            <label class="c-form_input-img --product">画像を選択する
                <input type="file" name="image" accept="image/*" class="js-input_img">
            </label>
            <input type="image" src="{{ asset('img/icon-send.jpg') }}" alt="">
        </div>
    </section>
</div>
@endsection
