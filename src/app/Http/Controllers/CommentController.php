<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request,$id){
        Comment::create([
            'product_id' => $id,
            'user_id' => Auth::id(),
            'comment' => $request['comment'],
        ]);
        return redirect()->back();
    }
}
