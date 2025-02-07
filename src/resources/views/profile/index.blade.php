@extends('layouts.default')
@section('title', '商品一覧')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')
<div class="p-profile-index">
    <div class="p-profile-index_contents">
        <div class="p-profile-index_info">
            <div class="p-profile-index_img"><img src="{{ asset('img/dummy.png')}}" alt=""></div>
            <p class="p-profile-index_name">ユーザー名</p>
        </div>
        <a href="/mypage/profile" class="p-profile-index_link">プロフィールを編集</a>
    </div>
    <div class="c-product p-profile-index_product">
        <div class="c-product_links">
            <a href="" class="c-product_link --active">出品した商品</a>
            <a href="" class="c-product_link">購入した商品</a>
        </div>
        <ul class="c-product_lists">
            <li class="c-product_list"><a href="">
                <div class="c-product_list_img"><img src="{{ asset('img/dummy-product.png') }}" alt=""></div>
                <p class="c-product_list_name">商品名</p>
            </a></li>
            <li class="c-product_list"><a href="">
                <div class="c-product_list_img"><img src="{{ asset('img/dummy-product.png') }}" alt=""></div>
                <p class="c-product_list_name">商品名</p>
            </a></li>
            <li class="c-product_list"><a href="">
                <div class="c-product_list_img"><img src="{{ asset('img/dummy-product.png') }}" alt=""></div>
                <p class="c-product_list_name">商品名</p>
            </a></li>
            <li class="c-product_list"><a href="">
                <div class="c-product_list_img"><img src="{{ asset('img/dummy-product.png') }}" alt=""></div>
                <p class="c-product_list_name">商品名</p>
            </a></li>
            <li class="c-product_list"><a href="">
                <div class="c-product_list_img"><img src="{{ asset('img/dummy-product.png') }}" alt=""></div>
                <p class="c-product_list_name">商品名</p>
            </a></li>
            <li class="c-product_list"><a href="">
                <div class="c-product_list_img"><img src="{{ asset('img/dummy-product.png') }}" alt=""></div>
                <p class="c-product_list_name">商品名</p>
            </a></li>
        </ul>
    </div>

</div>
@endsection
