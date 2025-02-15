<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductListController extends Controller
{
    //
    public function index(Request $request) {
        $user_id = Auth::check() ? Auth::id() : null;
        $query_page = $request->query('page');
        $query_search = $request->query('search');

        $products = Product::when($user_id,function ($query) use($user_id,$query_page){
            if($query_page == 'mylist'){
                $query->whereHas('likes',function ($q)use($user_id){
                    return $q->where('user_id', $user_id);
                });
            }
            return $query->where('user_id', '!=', $user_id);
        })->when(!$user_id && $query_page == 'mylist', function($query){
            return $query->whereRaw('0=1');
        })->when($query_search,function($query)use($query_search){
            return $query->KeywordSearch($query_search);
        })->get();
        return view('index',compact('products'));
    }

    public function detail($id) {
        $user_id = Auth::check() ? Auth::id() : null;
        $product = Product::with(['comments.user','categories'])->find($id);
        $is_like = $user_id ? $product->likes()->where('user_id' , $user_id)->exists() : false;
        return view('detail', compact('product','is_like'));
    }

    public function like(Request $request){
        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
        $user_id = Auth::id();
        if(!$product->likes()->where('user_id',$user_id)->exists()){
            $product->likes()->attach($user_id);
        }else{
            $product->likes()->detach($user_id);
        }
        return redirect('item/'.$product_id);
    }
}
