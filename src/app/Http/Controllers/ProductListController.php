<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductListController extends Controller
{
    //
    public function index() {
        $user_id = Auth::check() ? Auth::id() : null;

        $products = Product::when($user_id,function ($query) use($user_id){
            return $query->where('user_id', '!=', $user_id);
        })->get();
        return view('index',compact('products'));
    }

    public function detail($id) {
        $product = Product::with('categories')->find($id);
        return view('detail', compact('product'));
    }
}
