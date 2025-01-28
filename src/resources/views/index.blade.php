@extends('layouts.default')
@section('title', '商品一覧')
@section('content')
<div class="c-product">
    <div class="c-product_links">
        <a href="" class="c-product_link">おすすめ</a>
        <a href="" class="c-product_link --active">マイリスト</a>
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
@endsection
