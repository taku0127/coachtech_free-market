<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function index($item){
        $product = Product::find($item);
        return view('stripe',compact('product'));
    }
    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));//シークレットキー
        $charge = Charge::create(array(
             'amount' => $request->input('price'),
             'currency' => 'jpy',
             'source'=> request()->stripeToken,
         ));
       return redirect('/');
    }

    public function conveni(Request $request){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $amount = $request->input('amount');
        $paymentMethod = $request->input('payment_method');
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount , // 金額 (円単位)
            'currency' => 'jpy',
            'payment_method_types' => ['konbini'],
            'payment_method' => $paymentMethod,
            'confirmation_method' => 'manual',
            'confirm' => true,
        ]);
        return response()->json(['redirect_url' => route('conveni/status', ['id' => $paymentIntent->id])]);
    }

    public function status(Request $request)
        {
            $id = $request->query('id');
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentIntent = \Stripe\PaymentIntent::retrieve($id);
            return view('status', ['paymentIntent' => $paymentIntent]);
        }
}
