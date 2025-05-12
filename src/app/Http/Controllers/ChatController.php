<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use App\Models\Chat;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($id){
        $user = Auth::user();
        // 商品情報とチャット情報
        $product = Product::with(['order.chats.user','order.user','user'])->find($id);

        // その他取引中商品(チャットの新規順)
        // 買った商品のレビューしてないもの
        $purchasedProducts = Product::whereHas('order', function ($query_order) use ($user) {
            $query_order->where('user_id', $user->id)->unreviewed($user->id);
        })->with('order.chats')->get();
        // 売った商品のレビューしてないもの
        $soldProducts = Product::where('user_id',$user->id)->whereHas('order', function ($query_order) use ($user){
            $query_order->unreviewed($user->id);
        })->with('order.chats')->get();
        $inTransaction = $purchasedProducts->merge($soldProducts);
        $otherTransactions = $inTransaction->filter(function ($item) use ($product) {
            return $item->id !== $product->id;
        })->sortByDesc(function ($product) {
            return optional($product->order->chats)->max('created_at');
        })->values();

        // 購入者にレビューされたかどうか
        $isReviewed = Review::where('order_id', $product->order->id)->where('reviewer_id', $product->order->user_id)->exists();

        //関係ない人はアクセスできない。
        if (is_null($product->order) || $user->id !== $product->user_id && $user->id !== optional($product->order)->user_id) {
            abort(403, 'このチャットにはアクセスできません。');
        }

        // チャットを表示したら自分宛未読分を既読にする
        $chatsOpponent = $product->order->chats->filter(function($chat) use($user) {
            return $chat->user_id !== $user->id;
        });
        foreach ($chatsOpponent as $chatOppoent) {
            $chatOppoent->update([
                'is_read' => true,
            ]);
        }

        return view('chat',compact('product','otherTransactions','user','isReviewed'));
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

    public function destroy(Request $request,$id){
        $chat = Chat::find($request->chat_id);
        $chat->delete();

        return redirect()->route('transaction_chat',['id' => $id]);
    }

    public function edit(ChatRequest $request,$id){
        $chat = Chat::find($request->chat_id);
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('public/chats');
            $imageName = basename($imagePath);
        }
        $chat->update([
            'message' => $request->message,
            'image_url' => $imageName ?? null,
        ]);
        return redirect()->route('transaction_chat',['id' => $id]);
    }

    public function review(Request $request,$id){
        $product = Product::with('order')->find($id);
        $userId = Auth::id();
        // レビュー登録
        Review::create([
            'order_id' => $product->order->id,
            'reviewer_id' => $userId,
            'reviewee_id' => $userId === $product->user_id ? $product->order->user_id : $product->user_id,
            'rating' => $request->rating,
        ]);
        // トップページへ遷移
        return redirect('/');
        }
}
