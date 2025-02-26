<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function index(){
        $categories = Category::all();
        $statuses = Status::all();
        return view('sell', compact('categories','statuses'));
    }

    public function store(SellRequest $request){
        $userId = Auth::id();
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('public/products');
            $imageName = basename($imagePath);
        }
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'brand' => $request->brand,
            'image' => $imageName,
            'price' => $request->price,
            'user_id' => $userId,
            'status_id' => $request->status,
        ]);
        if($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }
        return redirect('/');
    }
}
