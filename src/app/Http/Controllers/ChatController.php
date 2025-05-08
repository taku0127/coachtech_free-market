<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($id){
        $user = Auth::user();
        // 商品情報とチャット情報
        $product = Product::with(['order.chats.user','order.user','user'])->find($id);
        // その他取引中商品(チャットの新規順)
        $purchasedProducts = Product::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('order.chats')->get();
        $soldProducts = Product::where('user_id',$user->id)->whereHas('order')->with('order.chats')->get();
        $inTransaction = $purchasedProducts->merge($soldProducts);
        $otherTransactions = $inTransaction->filter(function ($item) use ($product) {
            return $item->id !== $product->id;
        })->sortByDesc(function ($product) {
            return optional($product->order->chats)->max('created_at');
        })->values();

        return view('chat',compact('product','otherTransactions','user'));
    }
}
