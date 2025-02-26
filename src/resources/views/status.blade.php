<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>決済画面</title>
</head>
<body>
    <h2>決済状況</h2>
<p>決済ステータス: {{ $paymentIntent->status == 'requires_action' ? 'お支払い未完了' : 'お支払い完了' }}</p>
@if ($paymentIntent->status == 'requires_action')
    <a href="{{ $paymentIntent->next_action->konbini_display_details->hosted_voucher_url }}">支払方法はこちら</a>
@endif
</body>
</html>
