<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //
    public function index($item){
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
        return view('purchase',compact('product','address','user'));
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
}
