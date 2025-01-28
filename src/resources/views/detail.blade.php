@extends('layouts.default')
@section('title', '商品の出品')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/item-detail.css') }}">
@endsection
@section('content')
<div class="l-container --item-detail">
    <div class="p-item-detail">
        <div class="p-item-detail_img">
            <img src="{{ asset('img/dummy-item.png')}}" alt="">
        </div>
        <div class="p-item-detail_content">
            <h1 class="p-item-detail_title">商品名<br><span>ブランド名</span></h1>
            <p class="p-item-detail_price">¥<span>47,000</span> (税込)</p>
            <div class="p-item-detail_icons">
                <div class="p-item-detail_icon">
                    <div class="p-item-detail_icon_img">
                        <img src="{{ asset('img/icon-star.png') }}" alt="">
                    </div>
                    <div class="p-item-detail_icon_count">3</div>
                </div>
                <div class="p-item-detail_icon">
                    <div class="p-item-detail_icon_img">
                        <img src="{{ asset('img/icon-fukidashi.png') }}" alt="">
                    </div>
                    <div class="p-item-detail_icon_count">1</div>
                </div>
            </div>
            <div class="p-item-detail_buy-btn"><p class="c-button">購入手続きへ</p></div>
            <h2 class="p-item-detail_content_title">商品説明</h2>
            <p class="p-item-detail_description">カラー：グレー<br>
                <br>
                新品<br>
                商品の状態は良好です。傷もありません。<br>
                <br>
                購入後、即発送いたします。
            </p>
            <h2 class="p-item-detail_content_title">商品説明</h2>
            <div class="p-item-detail_infos">
                <div class="p-item-detail_info">
                    <h3 class="p-item-detail_info_title">カテゴリー</h3>
                    <div class="p-item-detail_info_content --category">
                        <p class="p-item-detail_info_category">洋服</p>
                        <p class="p-item-detail_info_category">メンズ</p>
                    </div>
                </div>
                <div class="p-item-detail_info">
                    <h3 class="p-item-detail_info_title">商品の状態</h3>
                    <div class="p-item-detail_info_content">
                        <p class="p-item-detail_info_status">良好</p>
                    </div>
                </div>
            </div>
            <div class="p-item-detail_comment">
                <p class="p-item-detail_comment_title">コメント(1)</p>
                <div class="p-item-detail_comment_contents">
                    <div class="p-item-detail_comment_user">
                        <div class="p-item-detail_comment_user_img"><img src="{{ asset('img/dummy.png')}}" alt=""></div>
                        <p class="p-item-detail_comment_user_name">admin</p>
                    </div>
                    <p class="p-item-detail_comment_detail">こちらにコメントが入ります。</p>
                </div>
                <div class="p-item-detail_comment_input">
                    <p class="p-item-detail_comment_input_title">商品へのコメント</p>
                    <textarea name="" class="p-item-detail_comment_input_textarea" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="p-item-detail_comment_submit"><p class="c-button">コメントする</p></div>
            </div>
        </div>
    </div>
</div>
@endsection
