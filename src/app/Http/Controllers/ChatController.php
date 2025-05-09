<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Models\Chat;
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

        //関係ない人はアクセスできない。
        if (is_null($product->order) || $user->id !== $product->user_id && $user->id !== optional($product->order)->user_id) {
            abort(403, 'このチャットにはアクセスできません。');
        }

        return view('chat',compact('product','otherTransactions','user'));
    }

    public function store(ChatRequest $request){
        $userId = Auth::id();
        $productId = $request->id;
        $product = Product::with('order')->find($productId);
        // チャット作成
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('public/chats');
            $imageName = basename($imagePath);
        }
        Chat::create([
            'order_id' => $product->order->id,
            'user_id' => $userId,
            'message' => $request->message,
            'image_url' => $imageName ?? null,
        ]);
        // 画面更新
        return redirect()->back();
    }
}
