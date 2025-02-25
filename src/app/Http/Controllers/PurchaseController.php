<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\PaymentMethodRequest;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //
    public function index($item){
        $payment_methods = PaymentMethod::all();
        $product = Product::find($item);
        $user = Auth::user();
        if(session()->has('order_address')){
            $address = session()->get('order_address');
        }else{
            session(['order_address' => [
                'postcode' => $user->postcode,
                'address' => $user->address,
                'building' => $user->building,
            ]]);
            $address = session()->get('order_address');
        }
        return view('purchase',compact('product','address','user','payment_methods'));
    }

    public function changeAddress($item){
        $product_id = $item;
        return view('shipment',compact('product_id'));
    }

    public function storeAddress(AddressRequest $request,$item){
        $address = $request->all();
        session(['order_address' => $address]);
        return redirect('/purchase/'.$item);
    }

    public function store(AddressRequest $address_request,PaymentMethodRequest $payment_request,$item){
        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $item,
            'postcode' => $address_request->postcode,
            'address' => $address_request->address,
            'building' => $address_request->building,
            'payment_method_id' => $payment_request->payment,
        ]);

        Product::find($item)->update([
            'is_sold' => true,
        ]);
        session()->forget('order_address');
        return redirect('/charge/'.$item.'?payment='.$payment_request->payment);
    }
}
