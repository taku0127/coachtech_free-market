@extends('layouts.default')
@section('title', 'プロフィール')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')
<div class="p-profile-index">
    <div class="p-profile-index_contents">
        <div class="p-profile-index_info">
            <div class="p-profile-index_img"><img src="{{ isset($user->image) ? asset('storage/profile/'.$user->image) : asset('img/dummy.png')}}" alt=""></div>
            <div class="p-profile-index_content">
                <p class="p-profile-index_name">{{ $user->name }}</p>
                @if ($reviewAve)
                <ul class="p-profile-index_reviewStars">
                    @for ($i = 1; $i <= 5; $i++)
                        <li class="p-profile-index_reviewStar"><img src="{{ $reviewAve >= $i ? asset('img/icon-star_active.svg') : asset('img/icon-star_nonactive.svg') }}" alt=""></li>
                    @endfor
                </ul>
                @endif
            </div>
        </div>
        <a href="/mypage/profile" class="p-profile-index_link">プロフィールを編集</a>
    </div>
    <div class="c-product p-profile-index_product">
        <div class="c-product_links">
            <a href="{{ url()->current() }}?tab=sell" class="c-product_link{{ request()->query('tab') == null ? ' --active' :(request()->query('tab') == 'sell' ? ' --active' : '') }}">出品した商品</a>
            <a href="{{ url()->current() }}?tab=buy" class="c-product_link{{ request()->query('tab') == 'buy' ? ' --active' : '' }}">購入した商品</a>
            <a href="{{ url()->current() }}?tab=in_transaction" class="c-product_link{{ request()->query('tab') == 'in_transaction' ? ' --active' : '' }}">取引中の商品
                @if ($totalUnread > 0)
                    <span class="c-product_link_notify">{{$totalUnread}}</span>
                @endif
            </a>
        </div>
        <ul class="c-product_lists">
            @foreach ($products as $product)
            <li class="c-product_list">
                @php
                    $baseUrl = request()->query('tab') === 'in_transaction'
                        ? route('transaction_chat', ['id' => $product->id])
                        : '/item/'.$product->id;
                    $unreadCount = $product->getUnreadCount($user->id);
                @endphp
                <a href="{{ $baseUrl }}">
                    <div class="c-product_list_img">
                        @if (request()->query('tab') === 'in_transaction' && $unreadCount > 0)
                            <span class="c-product_list_img_notify">{{$unreadCount}}</span>
                        @endif
                        <img src="{{ asset('storage/products/'.$product->image) }}" alt=""></div>
                    <p class="c-product_list_name">{{ $product->name }}</p>
            </a></li>
            @endforeach
        </ul>
    </div>

</div>
@endsection
