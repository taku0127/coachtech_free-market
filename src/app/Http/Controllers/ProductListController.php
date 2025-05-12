<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductListController extends Controller
{
    public function index(Request $request) {
        $userId = Auth::check() ? Auth::id() : null;
        if($userId) {
            $user = User::find($userId);
        }
        $queryPage = $request->query('page');
        $querySearch = $request->query('search');
        if($userId && $user->email_verified_at == null) {
            $user->sendEmailVerificationNotification();
            return redirect('/email/verify');
        }
        $products = Product::when($userId,function ($query) use($userId,$queryPage){
            if($queryPage == 'mylist'){
                $query->whereHas('likes',function ($q)use($userId){
                    return $q->where('user_id', $userId);
                });
            }
            return $query->where('user_id', '!=', $userId);
        })->when(!$userId && $queryPage == 'mylist', function($query){
            return $query->whereRaw('0=1');
        })->when($querySearch,function($query)use($querySearch){
            return $query->KeywordSearch($querySearch);
        })->get();
        return view('index',compact('products'));
    }

    public function detail($id) {
        $userId = Auth::check() ? Auth::id() : null;
        $product = Product::with(['comments.user','categories'])->find($id);
        $isLike = $userId ? $product->likes()->where('user_id' , $userId)->exists() : false;
        return view('detail', compact('product','isLike'));
    }

    public function like(Request $request){
        $productId = $request->input('product_id');
        $product = Product::find($productId);
        $userId = Auth::id();
        if(!$product->likes()->where('user_id',$userId)->exists()){
            $product->likes()->attach($userId);
        }else{
            $product->likes()->detach($userId);
        }
        return redirect('item/'.$productId);
    }

    public function mypage(Request $request){
        $queryTab = $request->query('tab');
        $user = Auth::user();
        $products = null;
        // 買った商品のレビューしてないもの
        $purchasedProducts = Product::whereHas('order', function ($query_order) use ($user) {
            $query_order->where('user_id', $user->id)->unreviewed($user->id);
        })->with('order.chats')->get();
        // 売った商品のレビューしてないもの
        $soldProducts = Product::where('user_id',$user->id)->whereHas('order', function ($query_order) use ($user){
            $query_order->unreviewed($user->id);
        })->with('order.chats')->get();
        // 取引中商品全て(チャットの新規順)
        $inTransaction = $purchasedProducts->merge($soldProducts)->sortByDesc(function ($product) {
            return optional($product->order->chats)->max('created_at');
        })->values();

        if($queryTab == 'sell' || $queryTab == null){
            $products = Product::where('user_id', $user->id)->get();;
        } elseif($queryTab == 'buy') {
            $products = Order::where('user_id', $user->id)->with('product')->get()->pluck('product');
        } elseif($queryTab == 'in_transaction'){
            $products = $inTransaction;
        };

        $totalUnread = $inTransaction->reduce(function ($carry, $product) {
            return $carry + ($product->order->chats->where('is_read', false)->count() ?? 0);
        }, 0);
        return view('profile.index',compact('products','totalUnread','user'));
    }
}
