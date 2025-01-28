@extends('layouts.default')
@section('title', '商品の出品')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell-product.css') }}">
@endsection
@section('content')
<div class="l-container">
    <div class="p-sell-product">
        <h1 class="p-sell-product_title">商品の出品</h1>
        <form action="">
            @csrf
            <div class="c-form p-auth_content">
                <div class="c-form_group">
                    <p class="c-form_group_title">商品画像</p>
                    <div class="c-form_product-img js-preview-background">
                        <label class="c-form_input-img --product">画像を選択する
                            <input type="file" name="image" accept="image/*" class="js-input_img">
                        </label>
                    </div>
                </div>
                <div class="c-form_block">
                    <p class="c-form_block_title">商品の詳細</p>
                    <div class="c-form_group">
                        <p class="c-form_label">カテゴリー</p>
                        <div class="c-form_checkboxes">
                            <label for="fashion" class="c-form_checkbox">ファッション<input type="checkbox" name="category" id="fashion" value="ファッション"></label>
                            <label for="kaden" class="c-form_checkbox">家電<input type="checkbox" name="category" id="kaden" value="家電"></label>
                            <label for="interia" class="c-form_checkbox">インテリア<input type="checkbox" name="category" id="interia" value="インテリア"></label>
                            <label for="ladies" class="c-form_checkbox">レディース<input type="checkbox" name="category" id="ladies" value="レディース"></label>
                            <label for="mens" class="c-form_checkbox">メンズ<input type="checkbox" name="category" id="mens" value="メンズ"></label>
                            <label for="cosme" class="c-form_checkbox">コスメ<input type="checkbox" name="category" id="cosme" value="コスメ"></label>
                            <label for="book" class="c-form_checkbox">本<input type="checkbox" name="category" id="book" value="本"></label>
                            <label for="game" class="c-form_checkbox">ゲーム<input type="checkbox" name="category" id="game" value="ゲーム"></label>
                            <label for="sports" class="c-form_checkbox">スポーツ<input type="checkbox" name="category" id="sports" value="スポーツ"></label>
                            <label for="kitchen" class="c-form_checkbox">キッチン<input type="checkbox" name="category" id="kitchen" value="キッチン"></label>
                            <label for="handmade" class="c-form_checkbox">ハンドメイド<input type="checkbox" name="category" id="handmade" value="ハンドメイド"></label>
                            <label for="accessories" class="c-form_checkbox">アクセサリー<input type="checkbox" name="category" id="accessories" value="アクセサリー"></label>
                            <label for="hobby" class="c-form_checkbox">おもちゃ<input type="checkbox" name="category" id="hobby" value="おもちゃ"></label>
                            <label for="baby" class="c-form_checkbox">ベビー・キッズ<input type="checkbox" name="category" id="baby" value="ベビー・キッズ"></label>
                        </div>
                    </div>
                    <div class="c-form_group">
                        <p class="c-form_label">商品の状態</p>
                        <div class="c-form_select-wrap">
                            <select name="joutai" id="" class="c-form_select">
                                <option value="">選択してください</option>
                                <option value="">良好</option>
                                <option value="">目立った傷や汚れなし</option>
                                <option value="">やや傷や汚れあり</option>
                                <option value="">状態が悪い</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="c-form_block">
                    <p class="c-form_block_title">商品名と説明</p>
                    <div class="c-form_group">
                        <label for="name" class="c-form_label">商品名</label>
                        <input type="text" id="name" name="name" class="c-form_input">
                    </div>
                    <div class="c-form_group">
                        <label for="description" class="c-form_label">商品の説明</label>
                        <textarea class="c-form_input" name="description" id="description" cols="30" rows="5"></textarea>
                    </div>
                    <div class="c-form_group">
                        <label for="price" class="c-form_label">販売価格</label>
                        <input type="text" id="price" name="price" class="c-form_input --price">
                    </div>
                    <div class="c-form_buttons">
                        <button type="submit" class="c-button">出品する</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
