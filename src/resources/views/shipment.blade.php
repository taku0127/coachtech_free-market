@extends('layouts.default')
@section('title', '送付先住所の変更')
@section('css')
<link rel="stylesheet" href="{{ asset('css/shipment.css') }}">
@endsection
@section('content')
<div class="l-container">
    <div class="p-shipment">
        <h1 class="p-shipment_title">
            住所の変更
        </h1>
        <form action="/purchase/address/{{ $product_id }}" method="POST">
            @csrf
            <div class="c-form p-shipment_content">
                <div class="c-form_group">
                    <label for="postcode" class="c-form_label">郵便番号</label>
                    <input type="text" id="postcode" name="postcode" class="c-form_input" value=" {{old('postcode')}} ">
                    @error('postcode')
                    <p class="c-form_error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="c-form_group">
                    <label for="address" class="c-form_label">住所</label>
                    <input type="text" id="address" name="address" class="c-form_input" value=" {{old('address')}} ">
                    @error('address')
                    <p class="c-form_error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="c-form_group">
                    <label for="building" class="c-form_label">建物名</label>
                    <input type="text" id="building" name="building" class="c-form_input" value=" {{old('building')}} ">
                    @error('building')
                    <p class="c-form_error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="c-form_buttons --shipment">
                    <button type="submit" class="c-button">更新する</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
