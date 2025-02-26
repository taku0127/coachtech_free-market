<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>決済画面</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
    <div class="c-stripe">
        @if (request()->query->get('payment') == 1)
        <button id="conveni" type="submit">コンビニ決済する</button>
        @else
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
        @endif
    </div>
</body>
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{env('STRIPE_KEY')}}"); // 公開キー
    window.csrfToken = '{{ csrf_token() }}';

    document.getElementById("conveni").addEventListener("click", async function () {
        const { error, paymentMethod } = await stripe.createPaymentMethod({
            type: "konbini",
            billing_details: {
                name: "Taro Yamada",
                email: "taro@example.com",
            },
        });

        if (error) {
            console.error(error);
            alert("決済方法の作成に失敗しました");
        } else {
            // バックエンドに送信
            fetch("/conveni", {
                method: "POST",
                headers: { "Content-Type": "application/json",'X-CSRF-TOKEN': window.csrfToken, },
                body: JSON.stringify({
                    amount: {{ $product->price }}, // 5000円
                    payment_method: paymentMethod.id, // 取得した paymentMethod の ID
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.redirect_url) {
                 // リダイレクトURLを受け取ってページを遷移させる
                    window.location.href = data.redirect_url;
                } else {
                    console.error('エラー:', data.error);
                }
            })
            .catch(err => console.error(err));
        }
    });
</script>
</html>
