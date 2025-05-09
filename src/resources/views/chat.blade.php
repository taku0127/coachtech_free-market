@extends('layouts.default')
@section('title', '取引チャット')
@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection
@php
    $isSeller = $user->id == $product->user->id;
    $opponent = $isSeller ? $product->order->user : $product->user;
@endphp
<div class="p-chat">
    <aside class="p-chat_side">
        <h2 class="p-chat_side_title">その他の取引</h2>
        <ul class="p-chat_side_lists">
            @foreach ($otherTransactions as $otherTransaction)
            <li class="p-chat_side_list">
                <a href="{{route('transaction_chat', ['id' => $otherTransaction->id])}}" class="c-button --chatSide">{{$otherTransaction->name}}
                    @if ($otherTransaction->order->chats->where('is_read', false)->count() > 0)
                        <span class="p-chat_side_list_notify">{{$otherTransaction->order->chats->where('is_read', false)->count();}}</span>
                    @endif
            </a>
            </li>
            @endforeach
        </ul>
    </aside>
    <section class="p-chat_main">
        <div class="p-chat_head">
            <div class="p-chat_title">
                <div class="p-chat_title_img"><img src="{{
                    isset($opponent->image) ? asset('storage/profile/'.$opponent->image) : asset('img/dummy.png')}}" alt=""></div>
                <p class="p-chat_title_text">{{ $opponent->name; }}さんとの取引画面</p>
            </div>
            @if (!$isSeller)
            <p class="p-chat_head_btn">取引を完了する</p>
            @endif
        </div>
        <div class="p-chat_productInfo">
            <div class="p-chat_productInfo_img"><img src="{{ asset('storage/products/'.$product->image) }}" alt=""></div>
            <div class="p-chat_productInfo_texts">
                <h2 class="p-chat_productInfo_title">{{ $product->name }}</h2>
                <p class="p-chat_productInfo_text">¥<span>{{ number_format($product->price) }}</span> (税込)</p>
            </div>
        </div>
        <div class="p-chat_chat">
            @foreach ($product->order->chats as $chat)
                @php
                    $isUser = $chat->user->id == $user->id
                @endphp
                <div class="p-chat_chat_content{{ $isUser ? ' --ownMessage' : '';}}">
                    <div class="p-chat_chat_userInfo">
                        <div class="p-chat_chat_userInfo_img"><img src="{{ isset($chat->user->image) ? asset('storage/profile/'.$chat->user->image) : asset('img/dummy.png')}}" alt=""></div>
                        <p class="p-chat_chat_userInfo_name">{{$chat->user->name}}</p>
                    </div>
                    <p class="p-chat_chat_message">{{ $chat->message }}</p>
                    @if (isset($chat->image_url))
                    <div class="p-chat_chat_img">
                        <a href="{{asset('storage/chats/'.$chat->image_url)}}"><img src="{{asset('storage/chats/'.$chat->image_url)}}" alt=""></a>
                    </div>
                    @endif
                    @if ($isUser)
                        <div class="p-chat_chat_btns">
                            <p class="p-chat_chat_btn">編集</p>
                            <p class="p-chat_chat_btn">削除</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <form action="{{ route('transaction_chat',['id' => $product->id ]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="c-form">
                @if ($errors->any())
                    <ul class="p-chat_errors">
                        @foreach ($errors->all() as $error)
                            <li class="c-form_error">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="p-chat_sendBox">
                    <input type="text" name="message" id="" placeholder="取引メッセージを記入してください">
                    <label class="c-form_input-img --product">画像を選択する
                        <input type="file" name="image" accept="image/*">
                    </label>
                    <input type="image" src="{{ asset('img/icon-send.jpg') }}" alt="">
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
