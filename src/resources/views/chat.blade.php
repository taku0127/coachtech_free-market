@extends('layouts.default')
@section('title', '取引チャット')
@section('content')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection
@section('js')
    <script src="{{ asset('js/chat.js') }}"></script>
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
                    @php
                        $unreadCount = $otherTransaction->getUnreadCount($user->id);
                    @endphp
                    @if ($unreadCount > 0)
                        <span class="p-chat_side_list_notify">{{$unreadCount }}</span>
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
            <p class="p-chat_head_btn js-modalStart">取引を完了する</p>
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
                            <p class="p-chat_chat_btn"><a href="{{ route('transaction_chat' , ['id' => $product->id , 'edit' => $chat->id]) }}">編集</a></p>
                            <form action="{{ route('chat.delete',['id' => $product->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="chat_id" value="{{ $chat->id }}" >
                                <button class="p-chat_chat_btn">削除</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <form action="{{request()->has('edit') ? route('chat.edit',['id' => $product->id ]) : route('transaction_chat',['id' => $product->id ]) }}" method="POST" enctype="multipart/form-data" class="js-sendMessage">
            @csrf
            @if (request()->has('edit'))
                @php
                    $chatId = request()->query('edit');
                    $selectedChat = $product->order->chats->firstWhere('id', $chatId);
                @endphp
                @method('patch')
                <input type="hidden" name="chat_id" value="{{ $chatId }}">
            @endif
            <div class="c-form">
                @if ($errors->any())
                    <ul class="p-chat_errors">
                        @foreach ($errors->all() as $error)
                            <li class="c-form_error">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="p-chat_sendBox">
                    @if (request()->has('edit'))
                        <input type="text" name="message" placeholder="取引メッセージを記入してください" value="{{ old('message') ?? $selectedChat->message }}">
                    @else
                        <input class="js-chatImput" type="text" name="message" placeholder="取引メッセージを記入してください" value="{{ old('message') }}">
                    @endif
                    <div>
                        <label class="c-form_input-img --product">画像を選択する
                            <input class="js-file" type="file" name="image" accept="image/*">
                        </label>
                        <p class="js-fileName"></p>
                    </div>
                    <input type="image" src="{{ asset('img/icon-send.jpg') }}" alt="">
                </div>
            </div>
        </form>
        <div class="js-modalMain p-chat_review {{ $isReviewed && $isSeller ? 'is-active' : '' }}">
            <form action="{{ route('chat.review',['id' => $product->id]) }}" method="POST">
                @csrf
                <div class="p-chat_review_title">取引が完了しました。</div>
                <div class="p-chat_review_content">
                    <p class="p-chat_review_content_text">今回の取引相手はどうでしたか？</p>
                    <ul class="p-chat_stars js-reviewStars">
                        <li class="p-chat_star" data-review="1"><img src="{{ asset('img/icon-star_active.svg') }}" alt=""></li>
                        <li class="p-chat_star" data-review="2"><img src="{{ asset('img/icon-star_active.svg') }}" alt=""></li>
                        <li class="p-chat_star" data-review="3"><img src="{{ asset('img/icon-star_active.svg') }}" alt=""></li>
                        <li class="p-chat_star" data-review="4"><img src="{{ asset('img/icon-star_nonactive.svg') }}" alt=""></li>
                        <li class="p-chat_star" data-review="5"><img src="{{ asset('img/icon-star_nonactive.svg') }}" alt=""></li>
                    </ul>
                    <input type="hidden" name="rating" class="p-chat_review_number js-reviewInput" value="3">
                </div>
                <div class="p-chat_review_btnBox"><button class="c-button --review">送信する</button></div>
            </form>
        </div>
    </section>
</div>
@endsection
