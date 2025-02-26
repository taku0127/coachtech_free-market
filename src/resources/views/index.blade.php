@extends('layouts.default')
@section('title', '商品一覧')
@section('content')
<div class="c-product">
    <div class="c-product_links">
        <a href="/" class="c-product_link{{ request()->query('page') != 'mylist' ? ' --active' : '' }}">おすすめ</a>
        <a href="/?page=mylist" class="c-product_link{{ request()->query('page') == 'mylist' ? ' --active' : '' }}">マイリスト</a>
    </div>
    <ul class="c-product_lists">
        @foreach ($products as $product)
        <li class="c-product_list"><a href="/item/{{ $product->id }}">
            <div class="c-product_list_img">
                <img src="{{ asset('storage/products/'.$product->image) }}" alt="">
                @if ($product->is_sold)
                    <p class="c-product_list_img_sold">Sold</p>
                @endif
            </div>
            <p class="c-product_list_name">{{ $product->name; }}</p>
        </a></li>
        @endforeach
    </ul>
</div>
@endsection
