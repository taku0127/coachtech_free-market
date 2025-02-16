@extends('layouts.default')
@section('title', '商品の購入')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection
@section('content')
<div class="l-container --purchase">
    <div class="p-purchase">
        <div class="p-purchase_detail">
            <div class="p-purchase_item">
                <div class="p-purchase_item_img"><img src="{{ asset('storage/products/'.$product->image) }}" alt=""></div>
                <div class="p-purchase_item_detail">
                    <p class="p-purchase_item_title">{{ $product->name }}</p>
                    <p class="p-purchase_item_price">¥ {{ number_format($product->price) }}</p>
                </div>
            </div>
            <div class="p-purchase_select-payment">
                <p class="p-purchase_select-payment_title">支払い方法</p>
                <div class="p-purchase_select-payment_select-wrap">
                    <select name="payment" id="" class="p-purchase_select-payment_select js-selectPayment">
                        <option value="">選択してください</option>
                        <option value="コンビニ払い">コンビニ払い</option>
                        <option value="カード支払い">カード支払い</option>
                    </select>
                </div>
            </div>
            <div class="p-purchase_shipment">
                <div class="p-purchase_shipment_title-block">
                    <p class="p-purchase_shipment_title">配送先</p>
                    <a href="/purchase/address/{{ $product->id }}" class="p-purchase_shipment_link">変更する</a>
                </div>
                <p class="p-purchase_shipment_address">
                    {{ $address['postcode'] }}<br>
                    {{ $address['address'] }}<br>
                    {{ $address['building'] }}
                </p>
            </div>
        </div>
        <div class="p-purchase_buy">
            <div class="p-purchase_buy_block">
                <p class="p-purchase_buy_title">商品代金</p>
                <p class="p-purchase_buy_content">¥ {{ number_format($product->price) }}</p>
            </div>
            <div class="p-purchase_buy_block">
                <p class="p-purchase_buy_title">支払い方法</p>
                <p class="p-purchase_buy_content js-selectPayment_text">選択してください</p>
            </div>
            <div class="p-purchase_buy_link"><button class="c-button">購入する</button></div>
        </div>
    </div>
</div>
@endsection
