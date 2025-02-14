@extends('layouts.default')
@section('title', '商品の出品')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/item-detail.css') }}">
@endsection
@section('content')
<div class="l-container --item-detail">
    <div class="p-item-detail">
        <div class="p-item-detail_img">
            <div class="p-item-detail_img_wrap">
                <img src="{{ asset('storage/products/'.$product->image) }}" alt="">
                @if ($product->is_sold)
                <p class="c-product_list_img_sold">Sold</p>
                @endif
            </div>
        </div>
        <div class="p-item-detail_content">
            <h1 class="p-item-detail_title">{{ $product->name }}<br><span>{{ $product->brand }}</span></h1>
            <p class="p-item-detail_price">¥<span>{{ number_format($product->price) }}</span> (税込)</p>
            <div class="p-item-detail_icons">
                <div class="p-item-detail_icon">
                    <form action="/like" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="p-item-detail_icon_img{{ $is_like ? ' --active' : '' }}{{ Auth::check() ? '' : ' --noClick' }}">
                            <img src="{{ asset('img/icon-star.png') }}" alt="">
                        </button>
                    </form>
                    <div class="p-item-detail_icon_count">{{ $product->likes->count() }}</div>
                </div>
                <div class="p-item-detail_icon">
                    <div class="p-item-detail_icon_img">
                        <img src="{{ asset('img/icon-fukidashi.png') }}" alt="">
                    </div>
                    <div class="p-item-detail_icon_count">{{ $product->comments->count() }}</div>
                </div>
            </div>
            <div class="p-item-detail_buy-btn"><p class="c-button">購入手続きへ</p></div>
            <h2 class="p-item-detail_content_title">商品説明</h2>
            <p class="p-item-detail_description">{!! nl2br(e($product->description)) !!}
            </p>
            <h2 class="p-item-detail_content_title">商品説明</h2>
            <div class="p-item-detail_infos">
                <div class="p-item-detail_info">
                    <h3 class="p-item-detail_info_title">カテゴリー</h3>
                    <div class="p-item-detail_info_content --category">
                        @foreach ($product->categories as $category)
                        <p class="p-item-detail_info_category">{{ $category->name }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="p-item-detail_info">
                    <h3 class="p-item-detail_info_title">商品の状態</h3>
                    <div class="p-item-detail_info_content">
                        <p class="p-item-detail_info_status">{{ $product->status->name }}</p>
                    </div>
                </div>
            </div>
            <div class="p-item-detail_comment">
                <p class="p-item-detail_comment_title">コメント({{ $product->comments->count() }})</p>
                <div class="p-item-detail_comment_contents">
                    @foreach ($product->comments as $comment)
                    <div class="p-item-detail_comment_content">
                        <div class="p-item-detail_comment_user">
                            <div class="p-item-detail_comment_user_img"><img src="{{ asset('storage/profile/'.$comment->image) }}" alt=""></div>
                            <p class="p-item-detail_comment_user_name">{{ $comment->name }}</p>
                        </div>
                        <p class="p-item-detail_comment_detail">{{ $comment->pivot->comment }}</p>
                    </div>
                    @endforeach
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
