<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripeController extends Controller
{
    //
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
}
