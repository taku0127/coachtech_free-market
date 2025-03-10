@extends('layouts.default')
@section('title', '商品詳細')
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
                        <button class="p-item-detail_icon_img{{ $isLike ? ' --active' : '' }}{{ Auth::check() ? '' : ' --noClick' }}">
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
            @if (!$product->is_sold)
            <div class="p-item-detail_buy-btn"><a class="c-button" href="/purchase/{{ $product->id }}">購入手続きへ</a></div>
            @endif
            <h2 class="p-item-detail_content_title">商品説明</h2>
            <p class="p-item-detail_description">{!! nl2br(e($product->description)) !!}
            </p>
            <h2 class="p-item-detail_content_title">商品の情報</h2>
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
                            <div class="p-item-detail_comment_user_img"><img src="{{ isset($comment->user->image) ? asset('storage/profile/'.$comment->user->image) : asset('img/dummy.png'); }}" alt=""></div>
                            <p class="p-item-detail_comment_user_name">{{ $comment->user->name }}</p>
                        </div>
                        <p class="p-item-detail_comment_detail">{{ $comment->comment }}</p>
                    </div>
                    @endforeach
                </div>
                <form action="/comment/{{ $product->id }}" method="POST">
                    @csrf
                    <div class="p-item-detail_comment_input">
                        <p class="p-item-detail_comment_input_title">商品へのコメント</p>
                        <textarea name="comment" class="p-item-detail_comment_input_textarea" id="" cols="30" rows="10"></textarea>
                        @error('comment')
                        <p class="p-item-detail_comment_input_error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="p-item-detail_comment_submit"><button class="c-button">コメントする</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
