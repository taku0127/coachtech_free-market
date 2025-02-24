<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>決済画面</title>
</head>
<body>

    <form action="/charge" method="POST">
        @csrf
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="{{ $product->price }}"
        data-name="お支払い画面"
        data-label="payment"
        data-description="{{ $product->name }}"
        data-image="{{ asset('storage/products/'.$product->image) }}"
        data-locale="auto"
        data-currency="JPY">
       </script>
       <input type="hidden" name="price" value="{{ $product->price }}">
    </form>

</body>
</html>
