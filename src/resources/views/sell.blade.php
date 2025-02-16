@extends('layouts.default')
@section('title', '商品の出品')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell-product.css') }}">
@endsection
@section('content')
<div class="l-container">
    <div class="p-sell-product">
        <h1 class="p-sell-product_title">商品の出品</h1>
        <form action="/sell" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="c-form p-auth_content">
                <div class="c-form_group">
                    <p class="c-form_group_title">商品画像</p>
                    <div class="c-form_product-img js-preview-background">
                        <label class="c-form_input-img --product">画像を選択する
                            <input type="file" name="image" accept="image/*" class="js-input_img">
                        </label>
                    </div>
                    @error('image')
                    <p class="c-form_error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="c-form_block">
                    <p class="c-form_block_title">商品の詳細</p>
                    <div class="c-form_group">
                        <p class="c-form_label">カテゴリー</p>
                        <div class="c-form_checkboxes">
                            @foreach ($categories as $category)
                            <label for="category-{{ $category->id }}" class="c-form_checkbox">{{ $category->name }}<input type="checkbox" name="categories[]" id="category-{{ $category->id }}" value="{{ $category->id }}" {{ old('categories') ? (in_array($category->id, old('categories')) ? 'checked' : '' ): '' }}></label>
                            @endforeach
                        </div>
                        @error('categories')
                        <p class="c-form_error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="c-form_group">
                        <p class="c-form_label">商品の状態</p>
                        <div class="c-form_select-wrap">
                            <select name="status" id="" class="c-form_select">
                                <option value="">選択してください</option>
                                @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" {{ old('status') == $status->id ? 'selected' : '' ;}}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('status')
                        <p class="c-form_error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="c-form_block">
                    <p class="c-form_block_title">商品名と説明</p>
                    <div class="c-form_group">
                        <label for="name" class="c-form_label">商品名</label>
                        <input type="text" id="name" name="name" class="c-form_input" value="{{ old('name') }}">
                        @error('name')
                        <p class="c-form_error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="c-form_group">
                        <label for="brand" class="c-form_label">ブランド名</label>
                        <input type="text" id="brand" name="brand" class="c-form_input" value="{{ old('brand') }}">
                    </div>
                    <div class="c-form_group">
                        <label for="description" class="c-form_label">商品の説明</label>
                        <textarea class="c-form_input" name="description" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="c-form_error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="c-form_group">
                        <label for="price" class="c-form_label">販売価格</label>
                        <input type="number" id="price" name="price" class="c-form_input --price" value="{{ old('price') }}">
                        @error('price')
                        <p class="c-form_error">
                            {{ $message }}
                        </p>
                        @enderror
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
