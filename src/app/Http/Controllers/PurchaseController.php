<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //
    public function index($item){
        $product = Product::find($item);
        $user = Auth::user();
        session(['order_address' => [
            'postcode' => $user->postcode,
            'address' => $user->address,
            'building' => $user->building,
        ]]);
        $address = session()->get('order_address');
        return view('purchase',compact('product','address','user'));
    }
}
